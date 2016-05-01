<?php

namespace Pages\PagesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pages\PagesBundle\Validator\Constraints as CustomAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Pages\PagesBundle\Repository\PageRepository")
 */
class Page implements BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=125)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     * @CustomAssert\ConstraintsCheckUrl()
     */
    private $contenu;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updateAt;

    /**
     * @Gedmo\Timestampable(on="change", field="titre")
     * @ORM\Column(name="title_changed", type="datetime", nullable=true)
     */
    protected $titleChanged;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Page
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Page
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

