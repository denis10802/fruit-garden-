<?php

namespace App\Entity;

use App\Repository\TreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreeRepository::class)]
class Tree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $category = '';

    #[ORM\Column]
    private int $numberOfFruits = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNumberOfFruits(): ?int
    {
        return $this->numberOfFruits;
    }

    public function setNumberOfFruits(int $numberOfFruits): self
    {
        $this->numberOfFruits = $numberOfFruits;

        return $this;
    }
}
