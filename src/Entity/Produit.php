<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @UniqueEntity("nom")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 1,
     * max = 255
     * )
     * @Assert\NotNull
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     * min = 1,
     * max = 255
     * )
     * @Assert\NotNull
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(value = 0)
     * @Assert\NotNull
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\GreaterThanOrEqual(value = 0)
     */
    private $Prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contenupanier", inversedBy="Produit")
     */
    private $contenupanier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getContenupanier(): ?Contenupanier
    {
        return $this->contenupanier;
    }

    public function setContenupanier(?Contenupanier $contenupanier): self
    {
        $this->contenupanier = $contenupanier;

        return $this;
    }
}
