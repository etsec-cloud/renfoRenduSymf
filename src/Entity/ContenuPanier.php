<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ContenupanierRepository")
 */
class Contenupanier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="contenupanier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Produit;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Panier", inversedBy="contenupanier", cascade={"persist", "remove"})
     */
    private $Panier;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\GreaterThan(value = 0)
     */
    private $Quantite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Dateajout;

    public function __construct()
    {
        $this->setProduit($produit);
        $this->setDateAjout(new \DateTime);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
            $produit->setContenupanier($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produit->contains($produit)) {
            $this->Produit->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getContenupanier() === $this) {
                $produit->setContenupanier(null);
            }
        }

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->Panier;
    }

    public function setPanier(?Panier $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getDateajout(): ?\DateTimeInterface
    {
        return $this->Dateajout;
    }

    public function setDateajout(\DateTimeInterface $Dateajout): self
    {
        $this->Dateajout = $Dateajout;

        return $this;
    }
}
