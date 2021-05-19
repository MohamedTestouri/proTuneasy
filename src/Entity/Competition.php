<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 * @ORM\Table(name="`competition`")
 */
class Competition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("competition:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="le nom est vide")
     * @Groups("competition:read")
     */
    private $Nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Assert\NotBlank(message="description est vide")
     * @Groups("competition:read")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Assert\NotBlank(message="Categorie est vide")
     * @Groups("competition:read")
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *  @Assert\NotBlank(message="nombre de place est vide")
     * @Groups("competition:read")
     */
    private $nombre_de_place;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Assert\NotBlank(message="image est vide")
     * @Groups("competition:read")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Assert\NotBlank(message="adresse est vide")
     * @Groups("competition:read")
     */
    private $adresse;

    /**
     * @ORM\Column(type="date", nullable=true)
     *  @Assert\NotBlank(message="la date est vide")
     * @Groups("competition:read")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNombreDePlace(): ?int
    {
        return $this->nombre_de_place;
    }

    public function setNombreDePlace(?int $nombre_de_place): self
    {
        $this->nombre_de_place = $nombre_de_place;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getId();
    }
}
