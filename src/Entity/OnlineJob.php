<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'online_jobs')]
class OnlineJob
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\Positive(message: "The ID must be a positive number.")]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\Positive(message: "The leave request ID must be a positive number.")]
    #[Assert\NotNull(message: "The leave request ID cannot be null.")]
    private ?int $leaveRequestId = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: "The title cannot be empty.")]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: "The title must be at least {{ limit }} characters long.",
        maxMessage: "The title cannot be longer than {{ limit }} characters."
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "The post content cannot be empty.")]
    #[Assert\Length(
        min: 10,
        minMessage: "The post must be at least {{ limit }} characters long."
    )]
    private ?string $post = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: "The start date cannot be null.")]
    #[Assert\LessThanOrEqual(
        propertyPath: "endDate",
        message: "The start date must be before or equal to the end date."
    )]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: "The end date cannot be null.")]
    #[Assert\GreaterThanOrEqual(
        propertyPath: "startDate",
        message: "The end date must be after or equal to the start date."
    )]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isConfirmed = false;

    // Getters and Setters (unchanged from original)
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeaveRequestId(): ?int
    {
        return $this->leaveRequestId;
    }

    public function setLeaveRequestId(int $leaveRequestId): self
    {
        $this->leaveRequestId = $leaveRequestId;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * Additional business logic validation
     */
    public function validate(): void
    {
        if ($this->startDate > $this->endDate) {
            throw new \InvalidArgumentException("End date must be after start date");
        }

        if ($this->startDate < new \DateTime('today')) {
            throw new \InvalidArgumentException("Start date cannot be in the past");
        }
    }
}