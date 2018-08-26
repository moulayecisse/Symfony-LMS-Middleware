<?php

namespace App\Entity;

class BookGroup
{
    /**
     * @var Book
     */
    private $book;

    /**
     * @var int
     */
    private $count;

    public function getBook()
    {
        return $this->book;
    }

    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }
}
