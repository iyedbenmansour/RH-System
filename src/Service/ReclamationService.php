<?php

namespace App\Service;

use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ReclamationService
{
    private $entityManager;
    private $reclamationRepository;
    private $mailer;
    private $emailService;
    private $badWords = ['badword1', 'badword2', 'badword3']; // Liste à compléter selon besoin

    public function __construct(
        EntityManagerInterface $entityManager,
        ReclamationRepository $reclamationRepository,
        MailerInterface $mailer,
        EmailService $emailService
    ) {
        $this->entityManager = $entityManager;
        $this->reclamationRepository = $reclamationRepository;
        $this->mailer = $mailer;
        $this->emailService = $emailService;
    }

    /**
     * Filtre le texte pour supprimer/remplacer les mots inappropriés
     */
    public function sanitizeText(string $text): string
    {
        foreach ($this->badWords as $word) {
            $text = str_ireplace($word, '***', $text);
        }
        return $text;
    }

    /**
     * Envoie un email de notification pour une nouvelle réclamation
     */
    public function sendEmail(Reclamation $reclamation, string $toEmail): void
    {
        $this->emailService->sendNewReclamationNotification(
            $toEmail,
            $reclamation->getTitle(),
            $reclamation->getDescription()
        );
    }

    /**
     * Ajoute une nouvelle réclamation
     */
    public function addReclamation(Reclamation $reclamation): bool
    {
        // Sanitize title and description
        $reclamation->setTitle($this->sanitizeText($reclamation->getTitle()));
        $reclamation->setDescription($this->sanitizeText($reclamation->getDescription()));

        try {
            $this->entityManager->persist($reclamation);
            $this->entityManager->flush();
            
            // Ici, on pourrait appeler sendEmail pour notifier un administrateur
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Récupère toutes les réclamations
     */
    public function getAllReclamations(): array
    {
        return $this->reclamationRepository->findAll();
    }

    /**
     * Récupère les réclamations d'un utilisateur spécifique
     */
    public function getReclamationsByUserId(int $userId): array
    {
        return $this->reclamationRepository->findBy(['userId' => $userId]);
    }

    /**
     * Récupère une réclamation par son ID
     */
    public function getReclamationById(int $id): ?Reclamation
    {
        return $this->reclamationRepository->find($id);
    }

    /**
     * Met à jour une réclamation complète
     */
    public function updateReclamation(Reclamation $reclamation): bool
    {
        // Sanitize title and description
        $reclamation->setTitle($this->sanitizeText($reclamation->getTitle()));
        $reclamation->setDescription($this->sanitizeText($reclamation->getDescription()));

        try {
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Met à jour le statut d'une réclamation
     */
    public function updateReclamationStatus(int $id, string $status): bool
    {
        // Validation du statut
        $validStatuses = ['Not Treated', 'In Progress', 'Resolved', 'Rejected'];
        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $reclamation = $this->reclamationRepository->find($id);
        if (!$reclamation) {
            return false;
        }

        $oldStatus = $reclamation->getStatueOfReclamation();
        
        // Ne rien faire si le statut est identique
        if ($oldStatus === $status) {
            return true;
        }
        
        try {
            $reclamation->setStatueOfReclamation($status);
            $this->entityManager->flush();
            
            // Notification de changement de statut
            // Dans un cas réel, on récupérerait l'email de l'utilisateur
            // $userEmail = $this->userRepository->find($reclamation->getUserId())->getEmail();
            // $this->emailService->sendStatusChangeNotification($userEmail, $reclamation->getTitle(), $oldStatus, $status);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Supprime une réclamation
     */
    public function deleteReclamation(int $id): bool
    {
        $reclamation = $this->reclamationRepository->find($id);
        if (!$reclamation) {
            return false;
        }

        try {
            // Vérifier si des fichiers sont associés à la réclamation
            $imagePath = $reclamation->getImagePath();
            $pdfPath = $reclamation->getPdfPath();
            
            // D'abord supprimer l'entité de la base de données
            $this->entityManager->remove($reclamation);
            $this->entityManager->flush();
            
            // Ensuite tenter de supprimer les fichiers physiques
            // Note: cette partie peut échouer sans affecter la suppression en BDD
            
            // Dans un environnement réel, nous utiliserions des paramètres Symfony
            // mais ici, nous utilisons des chemins relatifs par rapport au répertoire public
            $publicPath = dirname(__DIR__, 2) . '/public';
            
            // Ne pas supprimer les fichiers par défaut
            if ($imagePath && $imagePath !== 'no-image.jpg') {
                $fullImagePath = $publicPath . '/uploads/reclamation/images/' . $imagePath;
                if (file_exists($fullImagePath)) {
                    @unlink($fullImagePath); // Le @ supprime les warnings si le fichier n'existe pas
                }
            }
            
            if ($pdfPath && $pdfPath !== 'no-pdf.pdf') {
                $fullPdfPath = $publicPath . '/uploads/reclamation/pdfs/' . $pdfPath;
                if (file_exists($fullPdfPath)) {
                    @unlink($fullPdfPath);
                }
            }
            
            return true;
        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            error_log('Erreur lors de la suppression de la réclamation ' . $id . ': ' . $e->getMessage());
            return false;
        }
    }
}