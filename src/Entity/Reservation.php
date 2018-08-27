<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="PBook", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pBook;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function getPBook(): ?PBook
    {
        return $this->pBook;
    }

    public function setPBook(?PBook $pBook): self
    {
        $this->pBook = $pBook;

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
