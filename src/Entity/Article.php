<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $content;

    private string $subContent;

    public function __construct()
    {
        $this->subContent = substr($this->content, 0, 50) . "...";
    }
    
    #[ORM\Column(type: 'datetime', updatable:false)]
    private $createdAt;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * Get the value of subContent
     *
     * @return string
     */
    public function getSubContent(): string
    {
        return $this->subContent = substr($this->content, 0, 50) . "...";
    }

    /**
     * Set the value of subContent
     *
     * @param string $subContent
     *
     * @return self
     */
    public function setSubContent(string $subContent): self
    {
        $this->subContent = $subContent;

        return $this;
    }
}