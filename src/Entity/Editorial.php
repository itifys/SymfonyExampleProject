<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditorialRepository::class)
 */
class Editorial
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
     * @ORM\Column(type="string", length=255)
     */
    private $link_title;

    /**
     * @ORM\Column(type="integer")
     */
    private $link_title_font_size;

    /**
     * @ORM\Column(type="integer")
     */
    private $display_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video_link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="text")
     */
    private $creators;

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

    public function getLinkTitle(): ?string
    {
        return $this->link_title;
    }

    public function setLinkTitle(string $link_title): self
    {
        $this->link_title = $link_title;

        return $this;
    }

    public function getLinkTitleFontSize(): ?int
    {
        return $this->link_title_font_size;
    }

    public function setLinkTitleFontSize(int $link_title_font_size): self
    {
        $this->link_title_font_size = $link_title_font_size;

        return $this;
    }

    public function getDisplayType(): ?int
    {
        return $this->display_type;
    }

    public function setDisplayType(int $display_type): self
    {
        $this->display_type = $display_type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(string $video_link): self
    {
        $this->video_link = $video_link;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreators(): ?string
    {
        return $this->creators;
    }

    public function setCreators(string $creators): self
    {
        $this->creators = $creators;

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
