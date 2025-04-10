<?php

namespace App\Entity;

use App\Repository\ReponseReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseReclamationRepository::class)]
class ReponseReclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_rec = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column]
    private ?int $id_receiver = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse = null;

    #[ORM\Column(length: 255)]
    private ?string $pdf_path = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $statue_of_reponse_reclamation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRec(): ?int
    {
        return $this->id_rec;
    }

    public function setIdRec(int $id_rec): static
    {
        $this->id_rec = $id_rec;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdReceiver(): ?int
    {
        return $this->id_receiver;
    }

    public function setIdReceiver(int $id_receiver): static
    {
        $this->id_receiver = $id_receiver;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getPdfPath(): ?string
    {
        return $this->pdf_path;
    }

    public function setPdfPath(string $pdf_path): static
    {
        $this->pdf_path = $pdf_path;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getStatueOfReponseReclamation(): ?string
    {
        return $this->statue_of_reponse_reclamation;
    }

    public function setStatueOfReponseReclamation(string $statue_of_reponse_reclamation): static
    {
        $this->statue_of_reponse_reclamation = $statue_of_reponse_reclamation;

        return $this;
    }
}
