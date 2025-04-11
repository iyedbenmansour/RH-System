<?php
// src/Entity/Applicant.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: "App\Repository\ApplicantRepository")]
#[ORM\Table(name: "applicants")]
class Applicant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "integer")]
    private $userId;

    #[ORM\Column(type: "integer")]
    private $jobId;

    #[ORM\Column(type: "integer")]
    private $companyId;

    #[ORM\Column(type: "text", nullable: true)]
    private $comment;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private $additionalFile;

    #[ORM\Column(type: "datetime")]
    private $appliedDate;

    #[ORM\Column(type: "string", length: 50, options: ["default" => "Pending"])]
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