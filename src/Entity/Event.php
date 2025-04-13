<?php
// src/Entity/Event.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: "App\Repository\EventRepository")]
#[ORM\Table(name: "events")]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank]
    private \DateTimeInterface $date;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $location;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $organiser;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $eventType;

    #[ORM\Column(type: "integer")]
    #[Assert\PositiveOrZero]
    private int $nbParticipant = 0;

    #[ORM\Column(type: "float")]
    #[Assert\PositiveOrZero]
    private float $ticketPrice = 0.0;

    #[ORM\Column(type: "boolean")]
    private bool $hasFormation = false;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $formationId = null;

    #[ORM\Column(type: "float")]
    private float $longitude = 0.0;

    #[ORM\Column(type: "float")]
    private float $latitude = 0.0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getOrganiser(): string
    {
        return $this->organiser;
    }

    public function setOrganiser(string $organiser): self
    {
        $this->organiser = $organiser;
        return $this;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function setEventType(string $eventType): self
    {
        $this->eventType = $eventType;
        return $this;
    }

    public function getNbParticipant(): int
    {
        return $this->nbParticipant;
    }

    public function setNbParticipant(int $nbParticipant): self
    {
        $this->nbParticipant = $nbParticipant;
        return $this;
    }

    public function getTicketPrice(): float
    {
        return $this->ticketPrice;
    }

    public function setTicketPrice(float $ticketPrice): self
    {
        $this->ticketPrice = $ticketPrice;
        return $this;
    }

    public function isHasFormation(): bool
    {
        return $this->hasFormation;
    }

    public function setHasFormation(bool $hasFormation): self
    {
        $this->hasFormation = $hasFormation;
        if (!$hasFormation) {
            $this->formationId = null;
        }
        return $this;
    }

    public function getFormationId(): ?int
    {
        return $this->formationId;
    }

    public function setFormationId(?int $formationId): self
    {
        $this->formationId = $formationId;
        $this->hasFormation = ($formationId !== null);
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'Event{id=%d, name="%s", description="%s", date=%s, location="%s", organiser="%s", eventType="%s", nbParticipant=%d, ticketPrice=%.2f, hasFormation=%s, formationId=%s, longitude=%.6f, latitude=%.6f}',
            $this->id,
            $this->name,
            $this->description,
            $this->date->format('Y-m-d'),
            $this->location,
            $this->organiser,
            $this->eventType,
            $this->nbParticipant,
            $this->ticketPrice,
            $this->hasFormation ? 'true' : 'false',
            $this->formationId ?? 'null',
            $this->longitude,
            $this->latitude
        );
    }
}