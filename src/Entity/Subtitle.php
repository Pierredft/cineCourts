<?php

// src/Entity/Subtitle.php

namespace App\Entity;

use App\Repository\SubtitleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SubtitleRepository::class)]
#[Vich\Uploadable] // Annotation Vich
class Subtitle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $langue = null;

    #[ORM\Column(length: 255)]
    private ?string $abrev = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    // Ce champ n'est pas persisté en base de données
    #[Vich\UploadableField(mapping: 'subtitle_files', fileNameProperty: 'file')]
    private ?File $fileFile = null;

    #[ORM\Column(length: 255)]
    private ?string $titreFilm = null;

    #[ORM\ManyToOne(inversedBy: 'subtitle')]
    private ?Films $films = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): static
    {
        $this->langue = $langue;
        return $this;
    }

    public function getAbrev(): ?string
    {
        return $this->abrev;
    }

    public function setAbrev(string $abrev): static
    {
        $this->abrev = $abrev;
        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;
        return $this;
    }

    public function getFileFile(): ?File
    {
        return $this->fileFile;
    }

    public function setFileFile(?File $fileFile = null): void
    {
        $this->fileFile = $fileFile;
        if ($fileFile) {
            // C'est ici que vous pouvez mettre à jour l'entité
        }
    }

    public function getTitreFilm(): ?string
    {
        return $this->titreFilm;
    }

    public function setTitreFilm(string $titreFilm): static
    {
        $this->titreFilm = $titreFilm;

        return $this;
    }

    public function getFilms(): ?Films
    {
        return $this->films;
    }

    public function setFilms(?Films $films): static
    {
        $this->films = $films;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitreFilm();
    }
}

