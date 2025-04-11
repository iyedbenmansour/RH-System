<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ORM\Table(name: 'employees')]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $companyId = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?int $jobId = null;

    public function __construct(int $id = null, int $companyId = null, int $userId = null, int $jobId = null)
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->userId = $userId;
        $this->jobId = $jobId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): static
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getJobId(): ?int
    {
        return $this->jobId;
    }

    public function setJobId(int $jobId): static
    {
        $this->jobId = $jobId;

        return $this;
    }

    public function __toString(): string
    {
        return "Employee{id=" . $this->id . ", companyId=" . $this->companyId . ", userId=" . $this->userId . ", jobId=" . $this->jobId . "}";
    }
}