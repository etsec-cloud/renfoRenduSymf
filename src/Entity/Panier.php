<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Etat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Dateachat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContenuPanier", mappedBy="Panier", cascade={"persist", "remove"})
     */
    private $contenuPanier;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?bool
    {
        return $this->Etat;
    }

    public function setEtat(bool $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getDateachat(): ?\DateTimeInterface
    {
        return $this->Dateachat;
    }

    public function setDateachat(\DateTimeInterface $Dateachat): self
    {
        $this->Dateachat = $Dateachat;

        return $this;
    }

    public function getContenuPanier(): ?ContenuPanier
    {
        return $this->contenuPanier;
    }

    public function setContenuPanier(?ContenuPanier $contenuPanier): self
    {
        $this->contenuPanier = $contenuPanier;

        // set (or unset) the owning side of the relation if necessary
        $newPanier = null === $contenuPanier ? null : $this;
        if ($contenuPanier->getPanier() !== $newPanier) {
            $contenuPanier->setPanier($newPanier);
        }

        return $this;
    }
}
