<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendConfirmationEmail(string $to, string $username)
    {
        $email = (new Email())
            ->from('no-reply@tonsite.com') // Remplace par ton adresse d'envoi
            ->to($to)
            ->subject('Confirmation de votre inscription')
            ->html("
                <h1>Bienvenue $username !</h1>
                <p>Merci de vous être inscrit. Veuillez confirmer votre adresse email en cliquant sur le lien suivant :</p>
                <p><a href='https://tonsite.com/confirmation?email=$to'>Confirmer mon compte</a></p>
            ");

        $this->mailer->send($email);
    }
}
