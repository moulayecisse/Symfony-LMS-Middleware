<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin extends User
{
    public function __construct()
    {
        $this->roles = [ self::ROLE_ADMIN ];
    }
}
