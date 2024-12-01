<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Album;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Artist;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SongRepository::class)]
#[ApiResource]
#[ApiFilter(RangeFilter::class, properties: ['length'])]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['song:read'])]
    private ?string $title = null;

    #[ORM\Column(type: 'integer')]
    #[Groups(['song:read'])]
    private ?int $length = null;

    #[ORM\ManyToOne(targetEntity: Album::class, inversedBy: 'songs')]
    private ?Album $album = null;

    #[ORM\ManyToOne(targetEntity: Artist::class, inversedBy: 'songs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;
        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;
        return $this;
    }
}
