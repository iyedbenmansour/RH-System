<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'formation')]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $titre;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(length: 50)]
    private string $duree;

    #[ORM\Column]
    private float $prix;

    #[ORM\Column(length: 100)]
    private string $type;

    #[ORM\Column(length: 255)]
    private string $formateur;

    #[ORM\Column]
    private int $nbparticipant;

    #[ORM\Column(length: 50)]
    private string $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDuree(): string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;
        return $this;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getFormateur(): string
    {
        return $this->formateur;
    }

    public function setFormateur(string $formateur): static
    {
        $this->formateur = $formateur;
        return $this;
    }

    public function getNbparticipant(): int
    {
        return $this->nbparticipant;
    }

    public function setNbparticipant(int $nbparticipant): static
    {
        $this->nbparticipant = $nbparticipant;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'Formation{id=%d, titre=%s, description=%s, duree=%s, prix=%.2f, type=%s, formateur=%s, nbparticipant=%d, status=%s}',
            $this->id,
            $this->titre,
            $this->description,
            $this->duree,
            $this->prix,
            $this->type,
            $this->formateur,
            $this->nbparticipant,
            $this->status
        );
    }
}