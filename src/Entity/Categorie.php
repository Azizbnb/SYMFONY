<?php
namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(CategorieRepository::class)]
class Categorie {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    private int $id;

    #[ORM\Column(type:"string", length:50)]
    private string $name;

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}