<?php

namespace App\Service;

use App\Entity\Reclamation;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class EmailService
{
    private $mailer;
    private $senderEmail;

    public function __construct(MailerInterface $mailer, string $senderEmail = 'alabendawed@gmail.com')
    {
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
    }

    /**
     * Envoie une notification pour une nouvelle réclamation
     */
    public function sendNewReclamationNotification(string $toEmail, string $title, string $description): void
    {
        $subject = "Nouvelle réclamation: $title";
        $body = "Une nouvelle réclamation a été créée:\n\nTitre: $title\n\nDescription: $description";
        
        $this->sendEmail($toEmail, $subject, $body);
    }

    /**
     * Envoie une notification de changement de statut
     */
    public function sendStatusChangeNotification(string $toEmail, string $title, string $oldStatus, string $newStatus): void
    {
        $subject = "Mise à jour du statut de la réclamation: $title";
        $body = "Le statut de votre réclamation \"$title\" a été mis à jour.\n\nAncien statut: $oldStatus\nNouveau statut: $newStatus";
        
        $this->sendEmail($toEmail, $subject, $body);
    }

    /**
     * Méthode générique d'envoi d'email
     */
    private function sendEmail(string $toEmail, string $subject, string $body): void
    {
        $email = (new Email())
            ->from($this->senderEmail)
            ->to($toEmail)
            ->subject($subject)
            ->text($body);

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Log l'erreur pour un traitement ultérieur
            // En environnement de production, on pourrait utiliser un service de journalisation
        }
    }

    /**
     * Envoie un email de notification concernant une réclamation
     * @throws \Exception En cas d'erreur d'envoi
     */
    public function sendReclamationStatusEmail(Reclamation $reclamation, string $comment): void
    {
        $recipientEmail = 'alabendawed@gmail.com'; // Dans un cas réel, ceci serait l'email de l'employé
        
        // Si vous avez un système d'utilisateurs, vous pourriez récupérer l'email à partir de l'ID utilisateur
        // $user = $userRepository->find($reclamation->getUserId());
        // $recipientEmail = $user->getEmail();
        
        try {
            $email = (new TemplatedEmail())
                ->from(new Address($this->senderEmail, 'Service RH - Réclamations'))
                ->to($recipientEmail)
                ->subject('Mise à jour de votre réclamation: ' . $reclamation->getTitle())
                ->htmlTemplate('emails/reclamation_status_update.html.twig')
                ->context([
                    'reclamation' => $reclamation,
                    'comment' => $comment,
                    'status' => $reclamation->getStatueOfReclamation()
                ]);
                
            $this->mailer->send($email);
            
            // Pour le débogage, on pourrait ajouter des logs ici
            // Par exemple: file_put_contents('var/log/emails.log', date('Y-m-d H:i:s') . " - Email envoyé à $recipientEmail\n", FILE_APPEND);
        } catch (\Exception $e) {
            // On laisse l'exception remonter pour être traitée par le contrôleur
            // mais on pourrait ajouter des logs ici
            // file_put_contents('var/log/email_errors.log', date('Y-m-d H:i:s') . " - Erreur: " . $e->getMessage() . "\n", FILE_APPEND);
            throw $e;
        }
    }
    
    /**
     * Envoie un email de confirmation pour une nouvelle réclamation
     */
    public function sendNewReclamationConfirmation(Reclamation $reclamation): void
    {
        $recipientEmail = 'alabendawed@gmail.com'; // Dans un cas réel, ceci serait l'email de l'employé
        
        $email = (new TemplatedEmail())
            ->from(new Address($this->senderEmail, 'Service RH - Réclamations'))
            ->to($recipientEmail)
            ->subject('Confirmation de votre réclamation: ' . $reclamation->getTitle())
            ->htmlTemplate('emails/reclamation_confirmation.html.twig')
            ->context([
                'reclamation' => $reclamation
            ]);
            
        $this->mailer->send($email);
    }
} 