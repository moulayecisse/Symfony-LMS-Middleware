<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibraryRepository")
 */
class Library
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="time")
     */
    private $openingDate;

    /**
     * @ORM\Column(type="time")
     */
    private $closingTime;

    /**
     * @ORM\OneToMany(targetEntity="PBook", mappedBy="library", cascade={"remove"})
     */
    private $pBooks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Librarian", mappedBy="library")
     */
    private $librarians;

    public function __construct()
    {
        $this->pBooks = new ArrayCollection();
    }

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getOpeningDate(): ?\DateTimeInterface
    {
        return $this->openingDate;
    }

    public function setOpeningDate(\DateTimeInterface $openingDate): self
    {
        $this->openingDate = $openingDate;

        return $this;
    }

    public function getClosingTime(): ?\DateTimeInterface
    {
        return $this->closingTime;
    }

    public function setClosingTime(\DateTimeInterface $closingTime): self
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    /**
     * @return Collection|PBook[]
     */
    public function getPBooks(): Collection
    {
        return $this->pBooks;
    }

    public function addPBook(PBook $pBook): self
    {
        if (!$this->pBooks->contains($pBook)) {
            $this->pBooks[] = $pBook;
            $pBook->setLibrary($this);
        }

        return $this;
    }

    public function removePBook(PBook $pBook): self
    {
        if ($this->pBooks->contains($pBook)) {
            $this->pBooks->removeElement($pBook);
            // set the owning side to null (unless already changed)
            if ($pBook->getLibrary() === $this) {
                $pBook->setLibrary(null);
            }
        }

        return $this;
    }
}
