<?php

namespace App\Entity;

use App\Repository\HomePageContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HomePageContentRepository::class)
 */
class HomePageContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $content_type;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $content_class;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $content_first_title;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $content_second_title;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Assert\Image(
     *     minWidth = 16,
     *     maxWidth = 400,
     *     minHeight = 16,
     *     maxHeight = 400,
     *     allowLandscape = false,
     *     allowPortrait = false,
     *     allowLandscape=false,
     *     allowLandscapeMessage="The image is landscape oriented ({{ width }}x{{ height }}px).
    Landscape oriented images are not allowed.",
     *     allowPortrait=false,
     *     allowPortraitMessage="The image is portrait oriented ({{ width }}x{{ height }}px).
    Portrait oriented images are not allowed."
     * )
     * allowLandscape = false,
     */
    private $content_photo;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $content_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content_first_link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content_second_link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentType(): ?string
    {
        return $this->content_type;
    }

    public function setContentType(string $content_type): self
    {
        $this->content_type = $content_type;

        return $this;
    }

    public function getContentClass(): ?string
    {
        return $this->content_class;
    }

    public function setContentClass(string $content_class): self
    {
        $this->content_class = $content_class;

        return $this;
    }

    public function getContentFirstTitle(): ?string
    {
        return $this->content_first_title;
    }

    public function setContentFirstTitle(?string $content_first_title): self
    {
        $this->content_first_title = $content_first_title;

        return $this;
    }

    public function getContentSecondTitle(): ?string
    {
        return $this->content_second_title;
    }

    public function setContentSecondTitle(?string $content_second_title): self
    {
        $this->content_second_title = $content_second_title;

        return $this;
    }

    public function getContentPhoto()
    {
        return $this->content_photo;
    }

    public function setContentPhoto($content_photo): self
    {
        $this->content_photo = $content_photo;

        return $this;
    }

    public function getContentText(): ?string
    {
        return $this->content_text;
    }

    public function setContentText(string $content_text): self
    {
        $this->content_text = $content_text;

        return $this;
    }

    public function getContentFirstLink(): ?string
    {
        return $this->content_first_link;
    }

    public function setContentFirstLink(?string $content_first_link): self
    {
        $this->content_first_link = $content_first_link;

        return $this;
    }

    public function getContentSecondLink(): ?string
    {
        return $this->content_second_link;
    }

    public function setContentSecondLink(?string $content_second_link): self
    {
        $this->content_second_link = $content_second_link;

        return $this;
    }
}
