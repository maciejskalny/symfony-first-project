<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCategory", inversedBy="image")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Image
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductCategory|null
     */
    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    /**
     * @param ProductCategory|null $category
     * @return Image
     */
    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
