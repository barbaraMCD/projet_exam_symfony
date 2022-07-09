<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $TitreOeuvre;

    #[ORM\Column(type: 'text')]
    private $Contenu;

    #[ORM\ManyToOne(targetEntity: Genre::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(nullable: false)]
    private $Genre;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'oeuvres')]
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreOeuvre(): ?string
    {
        return $this->TitreOeuvre;
    }

    public function setTitreOeuvre(string $TitreOeuvre): self
    {
        $this->TitreOeuvre = $TitreOeuvre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->Genre;
    }

    public function setGenre(?Genre $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
