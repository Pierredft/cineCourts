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
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $duree = null;

    /**
     * @var Collection<int, FilmsMovies>
     */
    #[ORM\OneToMany(targetEntity: FilmsMovies::class, mappedBy: 'films')]
    private Collection $filmMovie;

    /**
     * @var Collection<int, FilmsTrailer>
     */
    #[ORM\OneToMany(targetEntity: FilmsTrailer::class, mappedBy: 'films')]
    private Collection $filmTrailer;

    public function __construct()
    {
        $this->filmMovie = new ArrayCollection();
        $this->filmTrailer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, FilmsMovies>
     */
    public function getFilmMovie(): Collection
    {
        return $this->filmMovie;
    }

    public function addFilmMovie(FilmsMovies $filmMovie): static
    {
        if (!$this->filmMovie->contains($filmMovie)) {
            $this->filmMovie->add($filmMovie);
            $filmMovie->setFilms($this);
        }

        return $this;
    }

    public function removeFilmMovie(FilmsMovies $filmMovie): static
    {
        if ($this->filmMovie->removeElement($filmMovie)) {
            // set the owning side to null (unless already changed)
            if ($filmMovie->getFilms() === $this) {
                $filmMovie->setFilms(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FilmsTrailer>
     */
    public function getFilmTrailer(): Collection
    {
        return $this->filmTrailer;
    }

    public function addFilmTrailer(FilmsTrailer $filmTrailer): static
    {
        if (!$this->filmTrailer->contains($filmTrailer)) {
            $this->filmTrailer->add($filmTrailer);
            $filmTrailer->setFilms($this);
        }

        return $this;
    }

    public function removeFilmTrailer(FilmsTrailer $filmTrailer): static
    {
        if ($this->filmTrailer->removeElement($filmTrailer)) {
            // set the owning side to null (unless already changed)
            if ($filmTrailer->getFilms() === $this) {
                $filmTrailer->setFilms(null);
            }
        }

        return $this;
    }
}
