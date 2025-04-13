<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;
    private $senderEmail;

    public function __construct(
        MailerInterface $mailer,
        string $senderEmail = 'alabendawed@gmail.com'
    ) {
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
} 