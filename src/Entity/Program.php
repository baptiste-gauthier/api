<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
#[ApiResource]
class Program
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hosted_by;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="programs")
     * @ORM\JoinTable(name="fav")
     */
    private $favorite;

    /**
     * @ORM\OneToMany(targetEntity=Show::class, mappedBy="program_id")
     */
    private $shows;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="belong")
     * @ORM\JoinTable(name="belong")
     */
    private $categories;

    public function __construct()
    {
        $this->favorite = new ArrayCollection();
        $this->shows = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHostedBy(): ?string
    {
        return $this->hosted_by;
    }

    public function setHostedBy(string $hosted_by): self
    {
        $this->hosted_by = $hosted_by;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Users $favorite): self
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite[] = $favorite;
        }

        return $this;
    }

    public function removeFavorite(Users $favorite): self
    {
        $this->favorite->removeElement($favorite);

        return $this;
    }

    /**
     * @return Collection|Show[]
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Show $show): self
    {
        if (!$this->shows->contains($show)) {
            $this->shows[] = $show;
            $show->setProgramId($this);
        }

        return $this;
    }

    public function removeShow(Show $show): self
    {
        if ($this->shows->removeElement($show)) {
            // set the owning side to null (unless already changed)
            if ($show->getProgramId() === $this) {
                $show->setProgramId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addBelong($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeBelong($this);
        }

        return $this;
    }
}
