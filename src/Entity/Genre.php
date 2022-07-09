<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $TitreGenre;

    #[ORM\OneToMany(mappedBy: 'Genre', targetEntity: Oeuvre::class)]
    private $oeuvres;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreGenre(): ?string
    {
        return $this->TitreGenre;
    }

    public function setTitreGenre(string $TitreGenre): self
    {
        $this->TitreGenre = $TitreGenre;

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
            $oeuvre->setGenre($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): self
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getGenre() === $this) {
                $oeuvre->setGenre(null);
            }
        }

        return $this;
    }
}
