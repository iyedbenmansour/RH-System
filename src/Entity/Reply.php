<?php
// src/Entity/Reply.php

namespace App\Entity;

use App\Repository\ReplyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReplyRepository::class)]
#[ORM\Table(name: 'replies')]
class Reply
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $postId;

    #[ORM\Column(type: 'integer')]
    private $userId;

    #[ORM\Column(type: 'text')]
    private $content;

    // Removed createdAt property entirely

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): self
    {
        $this->postId = $postId;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    // toString for debugging
    public function __toString(): string
    {
        return sprintf(
            'Reply{id=%d, postId=%d, userId=%d, content="%s"}',
            $this->id,
            $this->postId,
            $this->userId,
            $this->content
        );
    }
}