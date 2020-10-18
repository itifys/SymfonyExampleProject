<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
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
    private $tag;

    /**
     * @ORM\ManyToOne(targetEntity=QuestionairePart::class, inversedBy="tags")
     */
    private $questionairePart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getQuestionairePart(): ?QuestionairePart
    {
        return $this->questionairePart;
    }

    public function setQuestionairePart(?QuestionairePart $questionairePart): self
    {
        $this->questionairePart = $questionairePart;

        return $this;
    }
}
