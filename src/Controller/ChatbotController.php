<?php

// src/Controller/ChatbotController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    private $client;
    private $openaiApiKey;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->openaiApiKey = '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'; // replace this
    }

    #[Route('/chat', name: 'chatbot_index')]
    public function index()
    {
        return $this->render('chatbot/index.html.twig');
    }

    #[Route('/chat/send', name: 'chatbot_send', methods: ['POST'])]
    public function send(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $userMessage = $data['message'] ?? '';

        try {
            $response = $this->client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->openaiApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $userMessage]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 150
                ],
            ]);

            $content = $response->toArray();
            $botMessage = $content['choices'][0]['message']['content'];

            return new JsonResponse(['response' => $botMessage]);

        } catch (\Exception $e) {
            return new JsonResponse(['response' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    
}
