<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: "App\Repository\ReponseReclamationRepository")]
#[ORM\Table(name: "reponse_reclamations")]
class ReponseReclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank(message: "Complaint ID cannot be empty")]
    #[Assert\Positive(message: "Complaint ID must be a positive number")]
    private ?int $idRec = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank(message: "User ID cannot be empty")]
    #[Assert\Positive(message: "User ID must be a positive number")]
    private ?int $idUser = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\NotBlank(message: "Recipient ID cannot be empty")]
    #[Assert\Positive(message: "Recipient ID must be a positive number")]
    private ?int $idReceiver = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Response cannot be empty")]
    #[Assert\Length(
        min: 10,
        minMessage: "Response must contain at least {{ limit }} characters"
    )]
    private ?string $reponse = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $pdfPath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: "Date is required")]
    #[Assert\Type("\DateTimeInterface", message: "Date is not valid")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\NotBlank(message: "Status cannot be empty")]
    #[Assert\Choice(
        choices: ["Pending", "Processed", "Closed", "Rejected"],
        message: "Status {{ value }} is not valid. Valid values are: {{ choices }}"
    )]
    private ?string $statueOfReponseReclamation = null;

    // Constructor to initialize default values
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->statueOfReponseReclamation = "Pending";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRec(): ?int
    {
        return $this->idRec;
    }

    public function setIdRec(int $idRec): self
    {
        $this->idRec = $idRec;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdReceiver(): ?int
    {
        return $this->idReceiver;
    }

    public function setIdReceiver(int $idReceiver): self
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

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

    public function getStatueOfReponseReclamation(): ?string
    {
        return $this->statueOfReponseReclamation;
    }

    public function setStatueOfReponseReclamation(string $statueOfReponseReclamation): self
    {
        $this->statueOfReponseReclamation = $statueOfReponseReclamation;

        return $this;
    }
}
