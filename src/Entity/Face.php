<?php
// src/Entity/Face.php
namespace App\Entity;

use App\Repository\FaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FaceRepository::class)]
class Face
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $face_token = null;

    // Getters and setters...
    public function getId(): ?int { return $this->id; }
    public function getImage(): ?string { return $this->image; }
    public function setImage(string $image): static { $this->image = $image; return $this; }
    public function getUserId(): ?int { return $this->user_id; }
    public function setUserId(int $user_id): static { $this->user_id = $user_id; return $this; }
    public function getFaceToken(): ?string { return $this->face_token; }
    public function setFaceToken(string $face_token): static { $this->face_token = $face_token; return $this; }
}