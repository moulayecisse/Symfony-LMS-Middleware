<?php

namespace App\Entity;

use App\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("NONE")
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    use IdTrait;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $isbn;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $resume;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageNumber;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Image",
     *     mappedBy="book",
     *     cascade={"persist", "remove"}
     *     )
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToOne(targetEntity="EBook", mappedBy="book", cascade={"remove"})
     */
    private $eBook;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategory;

    /**
     * @MaxDepth(2)
     *
     * @Groups( { "details", "draft" } )
     *
     * @ORM\OneToMany(targetEntity="PBook", mappedBy="book", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $pBooks;

    public function getId()
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @return Book
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(?int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPBooks()
    {
        return $this->pBooks;
    }

    /**
     * @param mixed $pBooks
     *
     * @return Book
     */
    public function setPBooks($pBooks)
    {
        $this->pBooks = $pBooks;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEBook()
    {
        return $this->eBook;
    }

    /**
     * @param mixed $eBook
     *
     * @return Book
     */
    public function setEBook($eBook)
    {
        $this->eBook = $eBook;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Book
     */
    public function setSubCategory($subCategory)
    {
        $this->subCategory = $subCategory;

        return $this;
    }
}
