<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
#[ApiResource(
    normalizationContext: ['groups' => ['read:Category']]
)]
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:Category'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:Category','read:Program'])]
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:Category'])]
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Program::class, inversedBy="categories")
     * @ORM\JoinTable(name="belong")
     */
    #[Groups(['read:Category'])]
    private $belong;

    public function __construct()
    {
        $this->belong = new ArrayCollection();
    }

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

    /**
     * @return Collection|Program[]
     */
    public function getBelong(): Collection
    {
        return $this->belong;
    }

    public function addBelong(Program $belong): self
    {
        if (!$this->belong->contains($belong)) {
            $this->belong[] = $belong;
        }

        return $this;
    }

    public function removeBelong(Program $belong): self
    {
        $this->belong->removeElement($belong);

        return $this;
    }
}
