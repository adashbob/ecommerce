<?php

namespace Ecommerce\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Ecommerce\FrontBundle\Repository\CategorieRepository")
 */
class Categorie extends BaseEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Ecommerce\FrontBundle\Entity\Media", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=125)
     */
    private $name;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Ecommerce\FrontBundle\Entity\Produit", mappedBy="categorie")
     * @ORM\JoinColumn(nullable=true)
     */
    private $produits;


    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categorie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param \Ecommerce\FrontBundle\Entity\Media $image
     *
     * @return Categorie
     */
    public function setImage(\Ecommerce\FrontBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ecommerce\FrontBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Add produit
     *
     * @param \Ecommerce\FrontBundle\Entity\Produit $produit
     *
     * @return Categorie
     */
    public function addProduit(\Ecommerce\FrontBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \Ecommerce\FrontBundle\Entity\Produit $produit
     */
    public function removeProduit(\Ecommerce\FrontBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }

    public function __toString(){
        return $this->getName();
    }
}
