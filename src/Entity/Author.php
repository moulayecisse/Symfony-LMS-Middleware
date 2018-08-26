<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
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
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @Groups( "details" )
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @Groups( "details" )
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var Book[]
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="author")
     */
    private $books;

//    /**
//     * @var Book[]
//     * @ORM\ManyToMany(targetEntity="App\Entity\Book", mappedBy="authors")
//     */
//    private $contributedBooks;

//    /**
//     * @return Book[]
//     */
//    public function getContributedBooks()
//    {
//        return $this->contributedBookscontributedBooks;
//    }
//
//    /**
//     * @param mixed $contributedBooks
//     *
//     * @return Author
//     */
//    public function setContributedBooks($contributedBooks)
//    {
//        $this->contributedBooks = $contributedBooks;
//
//        return $this;
//    }

    public function __construct()
    {
        $this->books = [];
        $this->contributedBooks = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Book[]
     */
    public function getBooks(): array
    {
//        return $this->books;
        return [];
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removebook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
