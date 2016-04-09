<?php

namespace Ecommerce\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class BaseEntity
 * @package Ecommerce\FrontBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 *
 */
abstract class BaseEntity
{

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(){
        $this->createdAt = new \DateTime(null, new \DateTimeZone('Africa/Dakar'));
        $this->updatedAt = new \DateTime(null, new \DateTimeZone('Africa/Dakar'));
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime(null, new \DateTimeZone('Africa/Dakar'));
    }


}