<?php
// src/Entity/Applicant.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: "App\Repository\ApplicantRepository")]
#[ORM\Table(name: "applicants")]
class Applicant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "User ID cannot be blank.")]
    #[Assert\Positive(message: "User ID must be a positive number.")]
    private $userId;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Job ID cannot be blank.")]
    #[Assert\Positive(message: "Job ID must be a positive number.")]
    private $jobId;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Company ID cannot be blank.")]
    #[Assert\Positive(message: "Company ID must be a positive number.")]
    private $companyId;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\Length(
        max: 1000,
        maxMessage: "Comment cannot be longer than {{ limit }} characters."
    )]
    private $comment;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\File(
        maxSize: "5M",
        mimeTypes: [
            "application/pdf",
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "text/plain"
        ],
        mimeTypesMessage: "Please upload a valid document (PDF, DOC, DOCX or TXT)."
    )]
    private $additionalFile;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "Applied date cannot be blank.")]
    #[Assert\LessThanOrEqual(
        value: "now",
        message: "Applied date cannot be in the future."
    )]
    private $appliedDate;

    #[ORM\Column(type: "string", length: 50, options: ["default" => "Pending"])]
    #[Assert\NotBlank(message: "Status cannot be blank.")]
    #[Assert\Choice(
        choices: ["Pending", "Reviewed", "Interviewed", "Accepted", "Rejected"],
        message: "Invalid status. Must be one of: Pending, Reviewed, Interviewed, Accepted, Rejected."
    )]
    private $status = 'Pending';

    public function __construct()
    {
        $this->appliedDate = new \DateTime();
    }

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

    public function getJobId(): ?int
    {
        return $this->jobId;
    }

    public function setJobId(int $jobId): self
    {
        $this->jobId = $jobId;
        return $this;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getAdditionalFile(): ?string
    {
        return $this->additionalFile;
    }

    public function setAdditionalFile(?string $additionalFile): self
    {
        $this->additionalFile = $additionalFile;
        return $this;
    }

    public function getAppliedDate(): ?DateTimeInterface
    {
        return $this->appliedDate;
    }

    public function setAppliedDate(DateTimeInterface $appliedDate): self
    {
        $this->appliedDate = $appliedDate;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}