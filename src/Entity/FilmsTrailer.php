<?php

namespace App\Entity;

use App\Repository\FilmsTrailerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmsTrailerRepository::class)]
class FilmsTrailer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilname(): ?string
    {
        return $this->filname;
    }

    public function setFilname(string $filname): static
    {
        $this->filname = $filname;

        return $this;
    }
}
