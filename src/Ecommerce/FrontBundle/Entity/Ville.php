<?php


namespace Ecommerce\FrontBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville",
 *     uniqueConstraints={
 *     @ORM\UniqueConstraint(name="ville_slug", columns={"ville_slug"})},
 *     indexes={
 *     @ORM\Index(name="ville_departement", columns={"ville_departement"}),
 *     @ORM\Index(name="ville_nom", columns={"ville_nom"})})
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ville_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $villeId;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_departement", type="string", length=3, nullable=true)
     */
    private $villeDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_slug", type="string", length=255, nullable=true)
     */
    private $villeSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_nom", type="string", length=45, nullable=true)
     */
    private $villeNom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_code_postal", type="string", length=255, nullable=true)
     */
    private $villeCodePostal;


    /**
     * @var integer
     *
     * @ORM\Column(name="ville_population", type="integer", nullable=true)
     */
    private $villePopulation;


    /**
     * Get villeId
     *
     * @return integer
     */
    public function getVilleId()
    {
        return $this->villeId;
    }

    /**
     * Set villeDepartement
     *
     * @param string $villeDepartement
     * @return Villes
     */
    public function setVilleDepartement($villeDepartement)
    {
        $this->villeDepartement = $villeDepartement;

        return $this;
    }

    /**
     * Get villeDepartement
     *
     * @return string
     */
    public function getVilleDepartement()
    {
        return $this->villeDepartement;
    }

    /**
     * Set villeSlug
     *
     * @param string $villeSlug
     * @return Villes
     */
    public function setVilleSlug($villeSlug)
    {
        $this->villeSlug = $villeSlug;

        return $this;
    }

    /**
     * Get villeSlug
     *
     * @return string
     */
    public function getVilleSlug()
    {
        return $this->villeSlug;
    }

    /**
     * Set villeNom
     *
     * @param string $villeNom
     * @return Villes
     */
    public function setVilleNom($villeNom)
    {
        $this->villeNom = $villeNom;

        return $this;
    }

    /**
     * Get villeNom
     *
     * @return string
     */
    public function getVilleNom()
    {
        return $this->villeNom;
    }

    /**
     * @return string
     */
    public function getVilleCodePostal()
    {
        return $this->villeCodePostal;
    }

    /**
     * @param string $villeCodePostal
     */
    public function setVilleCodePostal($villeCodePostal)
    {
        $this->villeCodePostal = $villeCodePostal;
    }

    /**
     * @return int
     */
    public function getVillePopulation()
    {
        return $this->villePopulation;
    }

    /**
     * @param int $villePopulation
     */
    public function setVillePopulation($villePopulation)
    {
        $this->villePopulation = $villePopulation;
    }


}
