<?php
// src/Controller/EventNotificationController.php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventNotificationController extends AbstractController
{
    #[Route('/events/upcoming', name: 'app_events_upcoming')]
    public function upcomingEvents(EventRepository $eventRepository): JsonResponse
    {
        $startDate = new \DateTime();
        $endDate = (new \DateTime())->modify('+3 days');
        
        $events = $eventRepository->findEventsBetweenDates($startDate, $endDate);

        $formattedEvents = array_map(function($event) {
            return [
                'id' => $event->getId(),
                'name' => $event->getName(),
                'date' => $event->getDate()->format('Y-m-d'),
                'location' => $event->getLocation(),
            ];
        }, $events);

        return $this->json($formattedEvents);
    }
}