<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Ecommerce\FrontBundle\Entity\Commande", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="Ecommerce\FrontBundle\Entity\Client", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $adresses;


    public function __construct()
    {
        parent::__construct();
        $this->commandes = new ArrayCollection();
        $this->adresses = new ArrayCollection();
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
     * Add commande
     *
     * @param \Ecommerce\FrontBundle\Entity\Commande $commande
     *
     * @return User
     */
    public function addCommande(\Ecommerce\FrontBundle\Entity\Commande $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \Ecommerce\FrontBundle\Entity\Commande $commande
     */
    public function removeCommande(\Ecommerce\FrontBundle\Entity\Commande $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }




    /**
     * Add adress
     *
     * @param \Ecommerce\FrontBundle\Entity\Client $adress
     *
     * @return User
     */
    public function addAdresses(\Ecommerce\FrontBundle\Entity\Client $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \Ecommerce\FrontBundle\Entity\Client $adress
     */
    public function removeAdresses(\Ecommerce\FrontBundle\Entity\Client $adress)
    {
        $this->adresses->removeElement($adress);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }


}
