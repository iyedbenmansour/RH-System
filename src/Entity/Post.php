<?php
// src/Entity/Post.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'posts')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "User ID cannot be blank.")]
    #[Assert\Positive(message: "User ID must be a positive number.")]
    private $userId;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Post content cannot be blank.")]
    #[Assert\Length(
        min: 10,
        max: 5000,
        minMessage: "Post content must be at least {{ limit }} characters long.",
        maxMessage: "Post content cannot be longer than {{ limit }} characters."
    )]
    private $content;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: "Like count cannot be negative.")]
    private $likeCount = 0;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: "Dislike count cannot be negative.")]
    private $dislikeCount = 0;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank(message: "Creation date cannot be blank.")]
    #[Assert\LessThanOrEqual(
        value: "now",
        message: "Creation date cannot be in the future."
    )]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\File(
        maxSize: "2M",
        mimeTypes: [
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/webp"
        ],
        mimeTypesMessage: "Please upload a valid image (JPEG, PNG, GIF or WEBP)."
    )]
    private $imagePath;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\File(
        maxSize: "5M",
        mimeTypes: [
            "application/pdf",
            "application/x-pdf"
        ],
        mimeTypesMessage: "Please upload a valid PDF file."
    )]
    private $pdfPath;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    // Getters and Setters
    public function getId(): ?int
    {
        return $this->id;
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

    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    public function setLikeCount(int $likeCount): self
    {
        $this->likeCount = $likeCount;
        return $this;
    }

    public function incrementLikeCount(): self
    {
        $this->likeCount++;
        return $this;
    }

    public function getDislikeCount(): int
    {
        return $this->dislikeCount;
    }

    public function setDislikeCount(int $dislikeCount): self
    {
        $this->dislikeCount = $dislikeCount;
        return $this;
    }

    public function incrementDislikeCount(): self
    {
        $this->dislikeCount++;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    public function getPdfPath(): ?string
    {
        return $this->pdfPath;
    }

    public function setPdfPath(?string $pdfPath): self
    {
        $this->pdfPath = $pdfPath;
        return $this;
    }
}