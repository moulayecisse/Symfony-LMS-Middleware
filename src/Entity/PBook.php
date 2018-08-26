<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PBookRepository")
 */
class PBook
{
    public const STATUS_INSIDE = 'inside';
    public const STATUS_OUTSIDE = 'outside';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_NOT_AVAILABLE = 'no_available';
    public const STATUS = ['inside', 'outside', 'reserved', 'not_available'];

    /**
     * @ORM\Id()
     *
     * @ORM\GeneratedValue ()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="pBooks")
     * @ORM\JoinColumn(nullable=true)
     */
    private $book;

    /**
     * @ORM\Column(type="array", nullable=true)
     *
     * @var array
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="pBook", cascade={"remove"})
     */
    private $bookings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="pBooks")
     */
    private $library;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="pBook", cascade={"persist", "remove"})
     */
    private $reservations;

    /**
     * @return mixed
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * @param mixed $reservations
     */
    public function setReservations($reservations): void
    {
        $this->reservations = $reservations;
    }

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->status = ['inside' => 1];
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    public function setStatus(array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function addStatus(string $status): self
    {
        if (!$this->bookings->contains($status) && count($this->status) < 2) {
            $key = count($this->status);
            $this->status[$status] = $key;
        }

        return $this;
    }

    public function removeStatus(string $status): self
    {
        if ($this->status->contains($status)) {
            $this->status->removeElement($status);
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setPBook($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getPBook() === $this) {
                $booking->setPBook(null);
            }
        }

        return $this;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(?Library $library): self
    {
        $this->library = $library;

        return $this;
    }
}
