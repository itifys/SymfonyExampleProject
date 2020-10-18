<?php

namespace App\Entity;

use App\Repository\PlayPhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayPhotoRepository::class)
 */
class PlayPhoto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=PlayExternal::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playExternal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPlayExternal(): ?PlayExternal
    {
        return $this->playExternal;
    }

    public function setPlayExternal(?PlayExternal $playExternal): self
    {
        $this->playExternal = $playExternal;

        return $this;
    }
}
