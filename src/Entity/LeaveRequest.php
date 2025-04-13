<?php

namespace App\Entity;

use App\Repository\LeaveRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LeaveRequestRepository::class)]
#[ORM\Table(name: "leave_requests")]
class LeaveRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\Positive(message: "The ID must be a positive number.")]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive(message: "The employee ID must be a positive number.")]
    #[Assert\NotNull(message: "The employee ID cannot be null.")]
    private ?int $employeeId = null;

    #[ORM\Column]
    #[Assert\Positive(message: "The company ID must be a positive number.")]
    #[Assert\NotNull(message: "The company ID cannot be null.")]
    private ?int $companyId = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotNull(message: "The start date cannot be null.")]
    #[Assert\LessThanOrEqual(
        propertyPath: "endDate",
        message: "The start date must be before or equal to the end date."
    )]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotNull(message: "The end date cannot be null.")]
    #[Assert\GreaterThanOrEqual(
        propertyPath: "startDate",
        message: "The end date must be after or equal to the start date."
    )]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: "text", nullable: true)]
    #[Assert\Length(
        max: 2000,
        maxMessage: "The description cannot be longer than {{ limit }} characters."
    )]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The leave type cannot be empty.")]
    #[Assert\Choice(
        choices: ["vacation", "maladie", "normal", "bereavement", "maternite", "paternite", "other"],
        message: "Invalid leave type. Valid types are: vacation, sick, personal, bereavement, maternity, paternity, other."
    )]
    private ?string $leaveType = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: "The PDF path cannot be longer than {{ limit }} characters."
    )]
    private ?string $pdfPath = null;

    #[ORM\Column(type: "boolean")]
    private ?bool $isConfirmed = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeeId(): ?int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): self
    {
        $this->employeeId = $employeeId;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLeaveType(): ?string
    {
        return $this->leaveType;
    }

    public function setLeaveType(string $leaveType): self
    {
        $this->leaveType = $leaveType;
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

    public function isConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * Validates the leave request dates and other business logic
     */
    public function validate(): void
    {
        // Additional business logic validation
        if ($this->startDate > $this->endDate) {
            throw new \InvalidArgumentException("End date must be after start date");
        }

        if ($this->startDate < new \DateTime('today')) {
            throw new \InvalidArgumentException("Start date cannot be in the past");
        }
    }
}