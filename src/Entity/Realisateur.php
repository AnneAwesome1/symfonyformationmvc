<?php

namespace App\Entity;

use App\Repository\RealisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisateurRepository::class)]
class Realisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'realisateur', targetEntity: Film::class)]
    private Collection $film;

    #[ORM\OneToMany(mappedBy: 'realisateurfilm', targetEntity: Film::class)]
    private Collection $OneToMany;

    public function __construct()
    {
        $this->film = new ArrayCollection();
        $this->OneToMany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film->add($film);
            $film->setRealisateur($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->film->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getRealisateur() === $this) {
                $film->setRealisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getOneToMany(): Collection
    {
        return $this->OneToMany;
    }

    public function addOneToMany(Film $oneToMany): self
    {
        if (!$this->OneToMany->contains($oneToMany)) {
            $this->OneToMany->add($oneToMany);
            $oneToMany->setRealisateurfilm($this);
        }

        return $this;
    }

    public function removeOneToMany(Film $oneToMany): self
    {
        if ($this->OneToMany->removeElement($oneToMany)) {
            // set the owning side to null (unless already changed)
            if ($oneToMany->getRealisateurfilm() === $this) {
                $oneToMany->setRealisateurfilm(null);
            }
        }

        return $this;
    }
}
