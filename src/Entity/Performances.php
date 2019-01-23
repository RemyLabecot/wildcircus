<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerformancesRepository")
 */
class Performances
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Performers", mappedBy="performances")
     */
    private $performer;

    public function __construct()
    {
        $this->performer = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

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

    /**
     * @return Collection|Performers[]
     */
    public function getPerformer(): Collection
    {
        return $this->performer;
    }

    public function addPerformer(Performers $performer): self
    {
        if (!$this->performer->contains($performer)) {
            $this->performer[] = $performer;
            $performer->setPerformances($this);
        }

        return $this;
    }

    public function removePerformer(Performers $performer): self
    {
        if ($this->performer->contains($performer)) {
            $this->performer->removeElement($performer);
            // set the owning side to null (unless already changed)
            if ($performer->getPerformances() === $this) {
                $performer->setPerformances(null);
            }
        }

        return $this;
    }
}
