<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
#[ORM\Table(name: "reclamations")]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank(message: "User ID cannot be empty")]
    #[Assert\Positive(message: "User ID must be a positive number")]
    private ?int $userId = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank(message: "Company ID cannot be empty")]
    #[Assert\Positive(message: "Company ID must be a positive number")]
    private ?int $companyId = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank(message: "Title cannot be empty")]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: "Title must contain at least {{ limit }} characters",
        maxMessage: "Title must not exceed {{ limit }} characters"
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Description cannot be empty")]
    #[Assert\Length(
        min: 10,
        minMessage: "Description must contain at least {{ limit }} characters"
    )]
    private ?string $description = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $imagePath = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $pdfPath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: "Date is required")]
    #[Assert\Type("\DateTimeInterface", message: "Date is not valid")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::STRING, length: 50, options: ["default" => "Not Treated"])]
    #[Assert\NotBlank(message: "Status cannot be empty")]
    #[Assert\Choice(
        choices: ["Not Treated", "In Progress", "Resolved", "Rejected"],
        message: "Status {{ value }} is not valid. Valid values are: {{ choices }}"
    )]
    private ?string $statueOfReclamation = 'Not Treated';

    #[ORM\OneToMany(mappedBy: "reclamation", targetEntity: ReponseReclamation::class, orphanRemoval: true)]
    private Collection $reponses;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->statueOfReclamation = 'Not Treated';
        $this->reponses = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title ?? 'New Complaint';
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

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): self
    {
        $this->companyId = $companyId;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatueOfReclamation(): ?string
    {
        return $this->statueOfReclamation;
    }

    public function setStatueOfReclamation(string $statueOfReclamation): self
    {
        $this->statueOfReclamation = $statueOfReclamation;

        return $this;
    }

    /**
     * @return Collection<int, ReponseReclamation>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(ReponseReclamation $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setReclamation($this);
        }

        return $this;
    }

    public function removeReponse(ReponseReclamation $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getReclamation() === $this) {
                $reponse->setReclamation(null);
            }
        }

        return $this;
    }
}