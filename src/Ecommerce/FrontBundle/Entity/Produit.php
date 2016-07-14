<?php

namespace Ecommerce\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Ecommerce\FrontBundle\Repository\ProduitRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @ExclusionPolicy("all")
 */
class Produit extends BaseEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose()
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Ecommerce\FrontBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Ecommerce\FrontBundle\Entity\Tva")
     * @ORM\JoinColumn(nullable=false)
     * @Expose()
     */
    private $tva;

    /**
     * @ORM\ManyToOne(targetEntity="Ecommerce\FrontBundle\Entity\Categorie", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Le nom du produit doit être renseigné")
     * @Assert\Length(min="2", max="20")
     * @Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\Type(type="int")
     * @Expose()
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="available", type="boolean")
     * @Expose()
     */
    private $available;


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
     * @return Produit
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
     * @VirtualProperty()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Produit
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set avalable
     *
     * @param boolean $avalable
     *
     * @return Produit
     */
    public function setAvailable($avalable)
    {
        $this->available = $avalable;

        return $this;
    }

    /**
     * Get avalable
     *
     * @return bool
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set image
     *
     * @param \Ecommerce\FrontBundle\Entity\Media $image
     *
     * @return Produit
     */
    public function setImage(\Ecommerce\FrontBundle\Entity\Media $image)
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
     * Set tva
     *
     * @param \Ecommerce\FrontBundle\Entity\Tva $tva
     *
     * @return Produit
     */
    public function setTva(\Ecommerce\FrontBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return \Ecommerce\FrontBundle\Entity\Tva
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set categorie
     *
     * @param \Ecommerce\FrontBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\Ecommerce\FrontBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Ecommerce\FrontBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


}
