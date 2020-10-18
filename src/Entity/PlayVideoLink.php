<?php

namespace App\Entity;

use App\Repository\PlayVideoLinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayVideoLinkRepository::class)
 */
class PlayVideoLink
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
    private $video_link;

    /**
     * @ORM\ManyToOne(targetEntity=PlayExternal::class, inversedBy="video_links")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playExternal;

    public function getId(): ?int
    {
        return $this->id;
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
