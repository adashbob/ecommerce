<?php

namespace Ecommerce\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Class BaseEntity
 * @package Ecommerce\FrontBundle\Entity
 * @ORM\HasLifecycleCallbacks()
 *
 */
abstract class BaseEntity
{

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updateAt;


}