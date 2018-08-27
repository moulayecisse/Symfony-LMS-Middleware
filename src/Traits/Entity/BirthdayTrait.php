<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 27/08/2018
 * Time: 01:03.
 */

namespace App\Traits\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BirthdayTrait.
 */
trait BirthdayTrait
{
    /**
     * Name.
     *
     * @var DateTimeInterface
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * Set birthday.
     *
     * @param DateTimeInterface $birthday Content
     *
     * @return self
     */
    public function setBirthday(DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return DateTimeInterface
     */
    public function getBirthday(): DateTimeInterface
    {
        return $this->birthday;
    }
}
