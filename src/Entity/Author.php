<?php

namespace App\Entity;

use App\Traits\Entity\BiographyTrait;
use App\Traits\Entity\BirthdayTrait;
use App\Traits\Entity\FirstNameTrait;
use App\Traits\Entity\IdTrait;
use App\Traits\Entity\LastNameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book Author Class.
 *
 * @author  Moulaye Cissé <moulaye.c@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    use IdTrait;
    use FirstNameTrait;
    use LastNameTrait;
    use BiographyTrait;
    use BirthdayTrait;

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
