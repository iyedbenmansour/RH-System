<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:test-mail',
    description: 'Test the mailer configuration by sending a test email',
)]
class TestMailCommand extends Command
{
    private $mailer;
    
    public function __construct(MailerInterface $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        try {
            $email = (new Email())
                ->from('alabendawed@gmail.com')
                ->to('alabendawed@gmail.com')
                ->subject('Test Email - ' . date('Y-m-d H:i:s'))
                ->text('This is a test email to verify that the mailer configuration is working correctly.')
                ->html('<p>This is a test email to verify that the mailer configuration is working correctly.</p>');
            
            $this->mailer->send($email);
            
            $io->success('Test email sent successfully to alabendawed@gmail.com');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error('Error sending test email: ' . $e->getMessage());
            
            return Command::FAILURE;
        }
    }
} 