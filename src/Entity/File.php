<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="file_type", type="string")
 * @ORM\DiscriminatorMap({"file" = "File", "image" = "Image"})
 */
class File
{
    /**
     * @Groups( "details" )
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups( "details" )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @Groups( "details" )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLocal;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getisLocal()
    {
        return $this->isLocal;
    }

    /**
     * @param mixed $isLocal
     *
     * @return File
     */
    public function setIsLocal($isLocal)
    {
        $this->isLocal = $isLocal;

        return $this;
    }
}
