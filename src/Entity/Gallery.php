<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GalleryRepository::class)
 */
class Gallery
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=GalleryImage::class, mappedBy="gallery", orphanRemoval=true)
     */
    private $gallery_images;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function __construct()
    {
        $this->gallery_images = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

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

    /**
     * @return Collection|GalleryImage[]
     */
    public function getGalleryImages(): Collection
    {
        return $this->gallery_images;
    }

    public function addGalleryImage(GalleryImage $galleryImage): self
    {
        if (!$this->gallery_images->contains($galleryImage)) {
            $this->gallery_images[] = $galleryImage;
            $galleryImage->setGallery($this);
        }

        return $this;
    }

    public function removeGalleryImage(GalleryImage $galleryImage): self
    {
        if ($this->gallery_images->contains($galleryImage)) {
            $this->gallery_images->removeElement($galleryImage);
            // set the owning side to null (unless already changed)
            if ($galleryImage->getGallery() === $this) {
                $galleryImage->setGallery(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
