<?php

namespace App\Entity;

use App\Repository\PlayExternalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayExternalRepository::class)
 */
class PlayExternal
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
    private $poster;

    /**
     * @ORM\Column(type="date")
     */
    private $premiere_date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PlayPhoto::class, mappedBy="playExternal", orphanRemoval=true, cascade={"persist", "remove"} )
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity=PlayVideoLink::class, mappedBy="playExternal", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $video_links;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->video_links = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getPremiereDate(): ?\DateTimeInterface
    {
        return $this->premiere_date;
    }

    public function setPremiereDate(\DateTimeInterface $premiere_date): self
    {
        $this->premiere_date = $premiere_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PlayPhoto[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(PlayPhoto $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setPlayExternal($this);
        }

        return $this;
    }

    public function removePhoto(PlayPhoto $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getPlayExternal() === $this) {
                $photo->setPlayExternal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlayVideoLink[]
     */
    public function getVideoLinks(): Collection
    {
        return $this->video_links;
    }

    public function addVideoLink(PlayVideoLink $videoLink): self
    {
        if (!$this->video_links->contains($videoLink)) {
            $this->video_links[] = $videoLink;
            $videoLink->setPlayExternal($this);
        }

        return $this;
    }

    public function removeVideoLink(PlayVideoLink $videoLink): self
    {
        if ($this->video_links->contains($videoLink)) {
            $this->video_links->removeElement($videoLink);
            // set the owning side to null (unless already changed)
            if ($videoLink->getPlayExternal() === $this) {
                $videoLink->setPlayExternal(null);
            }
        }

        return $this;
    }
}
