<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShowRepository::class)
 * @ORM\Table(name="`show`")
 */
class Show
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_end;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hosted_by;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $guest;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="shows")
     */
    private $program_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getHostedBy(): ?string
    {
        return $this->hosted_by;
    }

    public function setHostedBy(?string $hosted_by): self
    {
        $this->hosted_by = $hosted_by;

        return $this;
    }

    public function getGuest(): ?string
    {
        return $this->guest;
    }

    public function setGuest(?string $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getProgramId(): ?Program
    {
        return $this->program_id;
    }

    public function setProgramId(?Program $program_id): self
    {
        $this->program_id = $program_id;

        return $this;
    }
}
