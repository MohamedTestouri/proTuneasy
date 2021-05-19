<?php

namespace App\Entity;

use App\Repository\ReservationCompetitionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReservationCompetitionRepository::class)
 * @ORM\Table(name="`ReservationCompetition`")
 */
class ReservationCompetition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("reservation:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank (message="veuillez mettre un nombre")
     * @Groups("reservation:read")
     */
    private $nbrparticipants;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class)
     */
    private $competition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrparticipants(): ?int
    {
        return $this->nbrparticipants;
    }

    public function setNbrparticipants(int $nbrparticipants): self
    {
        $this->nbrparticipants = $nbrparticipants;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }
}
