<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Psr\Log\LoggerInterface;

use App\Entity\LeaveRequest;

class MailerService
{
    private MailerInterface $mailer;
    private LoggerInterface $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger = null)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function sendConfirmationEmail(string $to, string $username)
    {
        $email = (new Email())
            ->from('alabendawed@gmail.com') // Use the same sender email as in your .env
            ->to($to)
            ->subject('Confirmation de votre inscription')
            ->html("
                <h1>Bienvenue $username !</h1>
                <p>Merci de vous être inscrit. Veuillez confirmer votre adresse email en cliquant sur le lien suivant :</p>
                <p><a href='https://tonsite.com/confirmation?email=$to'>Confirmer mon compte</a></p>
            ");

        try {
            $this->mailer->send($email);
            return true;
        } catch (TransportExceptionInterface $e) {
            if ($this->logger) {
                $this->logger->error('Failed to send confirmation email: ' . $e->getMessage());
            }
            return false;
        }
    }

    /**
     * Sends a test email to tniyed@gmail.com whenever a leave request is created
     */
    public function sendLeaveRequestTestEmail(LeaveRequest $leaveRequest): bool
    {
        $email = (new Email())
            ->from('alabendawed@gmail.com')
            ->to('alabendawed@gmail.com')
            ->subject('New Leave Request Submitted')
            ->html(
                sprintf(
                    '<h2>Leave Request Notification</h2>
                    <p>A new leave request has been submitted.</p>
                    <table border="1" cellpadding="5" style="border-collapse: collapse;">
                        <tr><th>Field</th><th>Value</th></tr>
                        <tr><td><strong>Employee ID</strong></td><td>%s</td></tr>
                        <tr><td><strong>Company ID</strong></td><td>%s</td></tr>
                        <tr><td><strong>From</strong></td><td>%s</td></tr>
                        <tr><td><strong>To</strong></td><td>%s</td></tr>
                        <tr><td><strong>Type</strong></td><td>%s</td></tr>
                    </table>
                    <p>Please review this request in the system.</p>',
                    $leaveRequest->getEmployeeId(),
                    $leaveRequest->getCompanyId(),
                    $leaveRequest->getStartDate() ? $leaveRequest->getStartDate()->format('Y-m-d') : '(not set)',
                    $leaveRequest->getEndDate() ? $leaveRequest->getEndDate()->format('Y-m-d') : '(not set)',
                    $leaveRequest->getLeaveType() ?? '(not set)'
                )
            );
            
        try {
            $this->mailer->send($email);
            return true;
        } catch (TransportExceptionInterface $e) {
            if ($this->logger) {
                $this->logger->error('Failed to send leave request notification: ' . $e->getMessage());
            }
            return false;
        }
    }
}