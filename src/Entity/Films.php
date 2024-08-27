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

    /**
     * @var Collection<int, Video>
     */
    #[ORM\OneToMany(targetEntity: Video::class, mappedBy: 'films')]
    private Collection $videos;

    /**
     * @var Collection<int, Acteurs>
     */
    #[ORM\ManyToMany(targetEntity: Acteurs::class, inversedBy: 'films')]
    private Collection $acteurs;

    /**
     * @var Collection<int, Realisateur>
     */
    #[ORM\ManyToMany(targetEntity: Realisateur::class, inversedBy: 'films')]
    private Collection $realisateur;

    /**
     * @var Collection<int, Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class, inversedBy: 'films')]
    private Collection $genres;

    #[ORM\Column(length: 255)]
    private ?string $ban = null;

    #[ORM\ManyToOne(inversedBy: 'films')]
    private ?Arcom $arcom = null;


    #[ORM\Column(type: 'boolean')]
    private ?bool $nouveauté = null;

    /**
     * @var Collection<int, Subtitle>
     */
    #[ORM\OneToMany(targetEntity: Subtitle::class, mappedBy: 'films')]
    private Collection $subtitle;


    public function __construct()
    {
        $this->videos = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->realisateur = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->subtitle = new ArrayCollection();
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

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setFilms($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getFilms() === $this) {
                $video->setFilms(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
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
    public function getRealisateur(): Collection
    {
        return $this->realisateur;
    }

    public function addRealisateur(Realisateur $realisateur): static
    {
        if (!$this->realisateur->contains($realisateur)) {
            $this->realisateur->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Realisateur $realisateur): static
    {
        $this->realisateur->removeElement($realisateur);

        return $this;
    }

    /**
     * @return Collection<int, Genres>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genres $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genres $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getBan(): ?string
    {
        return $this->ban;
    }

    public function setBan(string $ban): static
    {
        $this->ban = $ban;

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


    public function getNouveauté(): ?bool
    {
        return $this->nouveauté;
    }

    public function setNouveauté(bool $nouveauté): static
    {
        $this->nouveauté = $nouveauté;

    /**
     * @return Collection<int, Subtitle>
     */
    public function getSubtitle(): Collection
    {
        return $this->subtitle;
    }

    public function addSubtitle(Subtitle $subtitle): static
    {
        if (!$this->subtitle->contains($subtitle)) {
            $this->subtitle[] = $subtitle;
            $subtitle->setFilms($this);
        }

        return $this;
    }

    public function removeSubtitle(Subtitle $subtitle): static
    {
        if ($this->subtitle->removeElement($subtitle)) {
            // set the owning side to null (unless already changed)
            if ($subtitle->getFilms() === $this) {
                $subtitle->setFilms(null);
            }
        }


        return $this;
    }
}
