<?php

namespace Ecommerce\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="Ecommerce\FrontBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Media extends BaseEntity
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
     * @ORM\Column(type="string", length=255, name="name")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    protected $tempFile;

    protected $oldFile;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUploadRootDir()
    {
        return sprintf('%s/../../../../%s', __DIR__, 'web/upload');
    }

    public function getAbsolutePath(){
        return null === $this->path ? null : sprintf('%s/%s', $this->getUploadRootDir(), $this->path);
    }

    /**
     * Générer un nom pour l'image
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload(){
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        if (null !== $this->file)
            $this->path = sprintf('%s.%s', sha1(uniqid(mt_rand(), true)), $this->file->guessExtension());

    }

    public function getAssetPath()
    {
        return sprintf('upload/%s', $this->path);
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(), $this->path);
            unset($this->file);

            if ($this->oldFile != null) unlink($this->tempFile);
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFile)) unlink($this->tempFile);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

}
