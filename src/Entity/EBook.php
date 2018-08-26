<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 26/07/18
 * Time: 10:19.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EBook.
 *
 *
 * @ORM\Entity( repositoryClass="App\Repository\EBookRepository" )
 */
class EBook /*extends Book*/
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Book
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book", inversedBy="eBook")
     */
    private $book;

    /**
     * @var Book
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Book")
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberEBook", mappedBy="ebook")
     * @ORM\JoinColumn(nullable=false)
     */
    private $memberEBooks;

    public function __construct()
    {
        $this->memberEBooks = new ArrayCollection();
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @param Book $book
     *
     * @return EBook
     */
    public function setBook(Book $book): EBook
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Collection|MemberEBook[]
     */
    public function getMemberEBooks(): Collection
    {
        return $this->memberEBooks;
    }

    public function addMemberEBook(MemberEBook $memberEBook): self
    {
        if (!$this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks[] = $memberEBook;
            $memberEBook->setEBook($this);
        }

        return $this;
    }

    public function removeMemberEBook(MemberEBook $memberEBook): self
    {
        if ($this->memberEBooks->contains($memberEBook)) {
            $this->memberEBooks->removeElement($memberEBook);
            // set the owning side to null (unless already changed)
            if ($memberEBook->getEBook() === $this) {
                $memberEBook->setEBook(null);
            }
        }

        return $this;
    }
}
