<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass()
 *
 * @ORM\Entity(repositoryClass="App\Repository\SuperAdminRepository")
 */
class SuperAdmin extends User
{
    public function __construct()
    {
        $this->roles = [ self::ROLE_SUPER_ADMIN ];
    }

    public function getType()
    {
        return 'super_admin';
    }
}
