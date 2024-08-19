<?php

namespace App\Entity;

use App\Repository\FilmsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmsRepository::class)]
class Films
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $affiche = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoFilm = null;

    #[ORM\ManyToOne(inversedBy: 'films')]
    private ?Arcom $arcom = null;

    /**
     * @var Collection<int, Acteurs>
     */
    #[ORM\ManyToMany(targetEntity: Acteurs::class, inversedBy: 'films')]
    private Collection $acteurs;

    /**
     * @var Collection<int, Realisateur>
     */
    #[ORM\ManyToMany(targetEntity: Realisateur::class, inversedBy: 'films')]
    private Collection $realisateurs;

    public function __construct()
    {
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDuree(): ?\DateTimeImmutable
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeImmutable $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): static
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getVideoFilm(): ?string
    {
        return $this->videoFilm;
    }

    public function setVideoFilm(?string $videoFilm): static
    {
        $this->videoFilm = $videoFilm;

        return $this;
    }

    public function getArcom(): ?Arcom
    {
        return $this->arcom;
    }

    public function setArcom(?Arcom $arcom): static
    {
        $this->arcom = $arcom;

        return $this;
    }

    /**
     * @return Collection<int, Acteurs>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Acteurs $acteur): static
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs->add($acteur);
        }

        return $this;
    }

    public function removeActeur(Acteurs $acteur): static
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }

    /**
     * @return Collection<int, Realisateur>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Realisateur $realisateur): static
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Realisateur $realisateur): static
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }
}
