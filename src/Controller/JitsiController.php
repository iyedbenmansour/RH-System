<?php

// src/Controller/JitsiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class JitsiController extends AbstractController
{
    #[Route('/meeting/create', name: 'create_meeting')]
    public function createMeeting(): Response
    {
        // Generate a unique room name
        $roomName = Uuid::v4()->toBase58();
        
        return $this->redirectToRoute('join_meeting', ['roomName' => $roomName]);
    }

    #[Route('/meeting/join/{roomName}', name: 'join_meeting')]
    public function joinMeeting(string $roomName, Request $request): Response
    {
        $displayName = $request->query->get('displayName', 'Guest');
        $isModerator = $request->query->has('moderator');

        return $this->render('jitsi/meeting.html.twig', [
            'roomName' => $roomName,
            'displayName' => $displayName,
            'isModerator' => $isModerator,
            'domain' => 'meet.jit.si' 
        ]);
    }

    #[Route('/meeting/form', name: 'meeting_form')]
    public function meetingForm(): Response
    {
        return $this->render('jitsi/form.html.twig');
    }
}