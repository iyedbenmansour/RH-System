<?php
namespace App\Controller;

use App\Entity\Reply;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplyController extends AbstractController
{
    #[Route('/post/{postId}/reply', name: 'app_reply_create', methods: ['POST'])]
    public function create(
        int $postId,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $reply = new Reply();
        $reply->setPostId($postId);
        $reply->setUserId(1); // Using dummy user ID 1
        $reply->setContent($request->request->get('content'));
        
        $entityManager->persist($reply);
        $entityManager->flush();
        
        $this->addFlash('success', 'Your reply has been posted!');
        
        // Redirect back to post list (with an anchor to the specific post)
        return $this->redirectToRoute('app_post_list', ['_fragment' => 'post-' . $postId]);
    }
}