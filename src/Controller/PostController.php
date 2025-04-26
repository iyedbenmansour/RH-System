<?php
// src/Controller/PostController.php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Reply;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostController extends AbstractController
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/post/create', name: 'app_post_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $post = new Post();
        
        // Set a dummy user ID to 1
        $post->setUserId(1);

        if ($request->isMethod('POST')) {
            $post->setContent($request->request->get('content'));

            // Handle image file upload
            $imageFile = $request->files->get('image_file');
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $post->setImagePath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Failed to upload image.');
                }
            }

            // Handle PDF file upload
            $pdfFile = $request->files->get('pdf_file');
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $post->setPdfPath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Failed to upload PDF.');
                }
            }

            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post created successfully!');
            return $this->redirectToRoute('app_post_list');
        }

        return $this->render('post/create.html.twig');
    }

    #[Route('/posts', name: 'app_post_list', methods: ['GET'])]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Post::class)->findBy([], ['createdAt' => 'DESC']);
        
        // Get replies for each post
        $postsWithReplies = [];
        foreach ($posts as $post) {
            $replies = $entityManager->getRepository(Reply::class)->findBy(
                ['postId' => $post->getId()]
            );
            
            // Create an array with the post and its replies
            $postsWithReplies[] = [
                'post' => $post,
                'replies' => $replies
            ];
        }
        
        return $this->render('post/list.html.twig', [
            'postsWithReplies' => $postsWithReplies
        ]);
    }
    
    /**
     * Handle post like action
     */
    #[Route('/post/{id}/like', name: 'app_post_like', methods: ['POST'])]
    public function likePost(Post $post, EntityManagerInterface $entityManager): JsonResponse
    {
        // Increment like count
        $currentLikes = $post->getLikeCount();
        $post->setLikeCount($currentLikes + 1);
        
        $entityManager->persist($post);
        $entityManager->flush();
        
        return $this->json([
            'success' => true,
            'likeCount' => $post->getLikeCount()
        ]);
    }
    
    /**
     * Handle post dislike action
     */
    #[Route('/post/{id}/dislike', name: 'app_post_dislike', methods: ['POST'])]
    public function dislikePost(Post $post, EntityManagerInterface $entityManager): JsonResponse
    {
        // Increment dislike count
        $currentDislikes = $post->getDislikeCount();
        $post->setDislikeCount($currentDislikes + 1);
        
        $entityManager->persist($post);
        $entityManager->flush();
        
        return $this->json([
            'success' => true,
            'dislikeCount' => $post->getDislikeCount()
        ]);
    }
    
  #[Route('/api/generate-text', name: 'api_generate_text', methods: ['POST'])]
public function generateText(Request $request): JsonResponse
{
    $data = json_decode($request->getContent(), true);
    $prompt = $data['prompt'] ?? '';

    if (empty($prompt)) {
        return new JsonResponse([
            'success' => false,
            'message' => 'Prompt cannot be empty'
        ], Response::HTTP_BAD_REQUEST);
    }

    try {
        // Updated endpoint and API key
        $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
        $apiKey = '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';

        $requestBody = [
            'model' => 'gpt-4', // Specify the model
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens' => 100,
            'temperature' => 0.7, // Slightly higher for creativity
            'top_p' => 0.9,
            'stop' => ["\n"]
        ];

        $response = $this->httpClient->request('POST', $apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $requestBody,
            'timeout' => 15,
        ]);

        $content = $response->getContent();
        $statusCode = $response->getStatusCode();

        // Debugging logs
        error_log("API Response Status: $statusCode");
        error_log("API Response: $content");

        // Handle potential HTML errors (e.g., service errors)
        if (strpos($content, '<html') !== false || strpos($content, 'Service Unavailable') !== false) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Error: AI model is currently unavailable. Try again later.'
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $jsonResponse = json_decode($content, true);

        // Process response
        if ($statusCode === 200 && isset($jsonResponse['choices'][0]['message']['content'])) {
            $generatedText = trim($jsonResponse['choices'][0]['message']['content']);

            // Remove prompt if duplicated in response
            if (strpos($generatedText, $prompt) === 0) {
                $generatedText = trim(substr($generatedText, strlen($prompt)));
            }

            return new JsonResponse([
                'success' => true,
                'generated_text' => !empty($generatedText) ? $generatedText : "No meaningful text generated."
            ]);
        } else {
            return new JsonResponse([
                'success' => false,
                'message' => 'Failed to generate text. API response: ' . json_encode($jsonResponse)
            ], Response::HTTP_BAD_REQUEST);
        }

    } catch (\Exception $e) {
        error_log("Text generation error: " . $e->getMessage());
        return new JsonResponse([
            'success' => false,
            'message' => 'Error generating text: ' . $e->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}