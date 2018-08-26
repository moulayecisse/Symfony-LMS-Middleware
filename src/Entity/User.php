<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 26/08/2018
 * Time: 20:55
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity( repositoryClass="App\Repository\UserRepository" )
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap(
 *     {
 *          "user" = "User",
 *          "member" = "Member",
 *          "liberian" = "Librarian",
 *          "admin" = "Admin",
 *          "super_admin" = "SuperAdmin",
 *      }
 * )
 *
 */
class User implements UserInterface
{
    const ROLE_MEMBER = 'ROLE_MEMBER';
    const ROLE_LIBRARIAN = 'ROLE_LIBRARIAN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @noinspection PhpPropertyNamingConventionInspection
     */
    protected $id;

    /**
     * @param mixed $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @var array
     * @ORM\Column(type="simple_array")
     */
    protected $roles;

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getType()
    {
        return 'user';
    }


    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() : string
    {
        return $this->email;
    }
}