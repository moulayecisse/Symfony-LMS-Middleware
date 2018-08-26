<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="LibrarianRepository")
 */
class Librarian extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="librarians")
     * @ORM\JoinColumn(nullable=true)
     */
    private $library;

    public function __construct()
    {
        $this->roles = [ self::ROLE_LIBRARIAN ];
    }

    /**
     * @return mixed
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * @param mixed $library
     *
     * @return Librarian
     */
    public function setLibrary($library)
    {
        $this->library = $library;
        return $this;
    }
}
