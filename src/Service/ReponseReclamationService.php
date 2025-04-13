<?php

namespace App\Service;

use App\Entity\ReponseReclamation;
use App\Repository\ReponseReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ReponseReclamationService
{
    private $entityManager;
    private $reponseReclamationRepository;
    private $mailer;
    private $emailService;

    public function __construct(
        EntityManagerInterface $entityManager,
        ReponseReclamationRepository $reponseReclamationRepository,
        MailerInterface $mailer,
        EmailService $emailService
    ) {
        $this->entityManager = $entityManager;
        $this->reponseReclamationRepository = $reponseReclamationRepository;
        $this->mailer = $mailer;
        $this->emailService = $emailService;
    }

    /**
     * Ajoute une nouvelle réponse à une réclamation
     */
    public function addReponseReclamation(ReponseReclamation $reponseReclamation): bool
    {
        // Sanitize response text
        $reponseReclamation->setReponse($this->sanitizeText($reponseReclamation->getReponse()));

        try {
            $this->entityManager->persist($reponseReclamation);
            $this->entityManager->flush();
            
            // Here we could notify the user by email
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Récupère toutes les réponses aux réclamations
     */
    public function getAllReponseReclamations(): array
    {
        return $this->reponseReclamationRepository->findAll();
    }

    /**
     * Récupère les réponses pour une réclamation spécifique
     */
    public function getReponsesByReclamationId(int $reclamationId): array
    {
        return $this->reponseReclamationRepository->findBy(['idRec' => $reclamationId]);
    }

    /**
     * Récupère les réponses émises par un utilisateur
     */
    public function getReponsesByUserId(int $userId): array
    {
        return $this->reponseReclamationRepository->findBy(['idUser' => $userId]);
    }

    /**
     * Récupère les réponses reçues par un utilisateur
     */
    public function getReponsesByReceiverId(int $receiverId): array
    {
        return $this->reponseReclamationRepository->findBy(['idReceiver' => $receiverId]);
    }

    /**
     * Récupère une réponse par son ID
     */
    public function getReponseReclamationById(int $id): ?ReponseReclamation
    {
        return $this->reponseReclamationRepository->find($id);
    }

    /**
     * Met à jour une réponse
     */
    public function updateReponseReclamation(ReponseReclamation $reponseReclamation): bool
    {
        // Sanitize response
        $reponseReclamation->setReponse($this->sanitizeText($reponseReclamation->getReponse()));

        try {
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Met à jour le statut d'une réponse
     */
    public function updateReponseStatus(int $id, string $status): bool
    {
        try {
            $reponse = $this->reponseReclamationRepository->find($id);
            if (!$reponse) {
                return false;
            }
            
            $reponse->setStatueOfReponseReclamation($status);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Supprime une réponse
     */
    public function deleteReponseReclamation(int $id): bool
    {
        try {
            $reponse = $this->reponseReclamationRepository->find($id);
            if (!$reponse) {
                return false;
            }
            
            $this->entityManager->remove($reponse);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Nettoie le texte d'entrée pour prévenir les failles XSS
     */
    private function sanitizeText(string $text): string
    {
        // Remove HTML tags
        $text = strip_tags($text);
        // Convert special characters
        $text = htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        return $text;
    }
} 