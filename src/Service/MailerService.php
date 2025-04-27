<?php

namespace App\Service;

use App\Entity\Reclamation;
use App\Entity\LeaveRequest;
use App\Entity\Employee;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;

// Add this import for HttpClient:
use Symfony\Component\HttpClient\HttpClient;

class MailerService
{
    private $mailer;
    private $senderEmail;
    private $twig;

    // For Mailtrap API
    private $apiToken = '34bac4712a0f73772374f6ac6ecb42d8';
    private $apiHost = 'https://send.api.mailtrap.io';
    private $client = null; // Will be created when needed

    public function __construct(
        MailerInterface $mailer, 
        Environment $twig,
        string $senderEmail = 'alabendawed@gmail.com'
    ) {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->senderEmail = $senderEmail;
    }

    /**
     * Send notification for a new reclamation
     */
    public function sendNewReclamationNotification(string $title, string $description): void
    {
        $subject = "Nouvelle réclamation: $title";
        $body = "Une nouvelle réclamation a été créée:\n\nTitre: $title\n\nDescription: $description";
        $this->sendEmail($subject, $body);
    }

    /**
     * Send status change notification
     */
    public function sendStatusChangeNotification(string $title, string $oldStatus, string $newStatus): void
    {
        $subject = "Mise à jour du statut de la réclamation: $title";
        $body = "Le statut de votre réclamation \"$title\" a été mis à jour.\n\nAncien statut: $oldStatus\nNouveau statut: $newStatus";
        $this->sendEmail($subject, $body);
    }

    /**
     * Generic email sending method
     */
    private function sendEmail(string $subject, string $body): void
    {
        $email = (new Email())
            ->from($this->senderEmail)
            ->to('tniyed@gmail.com')
            ->subject($subject)
            ->text($body);

        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Log the error for later processing
            // In production environment, you might use a logging service
        }
    }

    /**
     * Send reclamation status email
     * @throws \Exception If sending fails
     */
    public function sendReclamationStatusEmail(Reclamation $reclamation, string $comment): void
    {
        try {
            $email = (new TemplatedEmail())
                ->from(new Address($this->senderEmail, 'Service RH - Réclamations'))
                ->to('tniyed@gmail.com')
                ->subject('Mise à jour de votre réclamation: ' . $reclamation->getTitle())
                ->htmlTemplate('emails/reclamation_status_update.html.twig')
                ->context([
                    'reclamation' => $reclamation,
                    'comment' => $comment,
                    'status' => $reclamation->getStatueOfReclamation()
                ]);
            $this->mailer->send($email);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function sendLeaveRequestConfirmationEmail(LeaveRequest $leaveRequest, Employee $employee): void
    {
        // Create client only if not already created
        if ($this->client === null) {
            $this->client = HttpClient::create();
        }
    
        $url = $this->apiHost . '/api/send';
        $recipient = 'iyedmansour29@gmail.com';
    
        $subject = 'New Leave Request Submitted';
        $bodyText = "A new leave request has been submitted.\n\nPlease check the system for details.";
    
        $payload = [
            'from' => [
                'email' => 'hello@demomailtrap.co',
                'name' => 'Leave Management System'
            ],
            'to' => [
                [
                    'email' => $recipient,
                    'name' => 'Iyed Mansour'
                ]
            ],
            'subject' => $subject,
            'text' => $bodyText,
        ];
    
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    
        $response = $this->client->request('POST', $url, [
            'headers' => $headers,
            'json' => $payload,
        ]);
    
        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new \Exception('Failed to send email via Mailtrap. Status code: ' . $statusCode . '. Response: ' . $response->getContent(false));
        }
    }

      /**
     * Send password reset email via Mailtrap API
     */
    public function sendPasswordResetEmail(string $recipientEmail, string $recipientName, string $resetUrl): void
    {
        if ($this->client === null) {
            $this->client = HttpClient::create();
        }

        // Prepend the localhost URL if not already present
        if (strpos($resetUrl, 'http://127.0.0.1:8000') === false) {
            $resetUrl = 'http://127.0.0.1:8000' . $resetUrl;
        }

        $subject = 'Réinitialisation de votre mot de passe';
        $htmlContent = $this->twig->render('emails/password_reset.html.twig', [
            'name' => $recipientName,
            'reset_url' => $resetUrl
        ]);

        $payload = [
            'from' => [
                'email' => 'hello@demomailtrap.co',
                'name' => 'JobPlatform'
            ],
            'to' => [
                [
                    'email' => $recipientEmail,
                    'name' => $recipientName
                ]
            ],
            'subject' => $subject,
            'html' => $htmlContent,
            'category' => 'password-reset'
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = $this->client->request('POST', $this->apiHost . '/api/send', [
            'headers' => $headers,
            'json' => $payload,
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new \Exception('Failed to send password reset email. Status: ' . $statusCode);
        }
    }
}