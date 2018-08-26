<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestimonialRepository")
 */
class Testimonial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @var Member
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="testimonials")
     */
    private $member;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return Testimonial
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }

    /**
     * @param Member $member
     * @return Testimonial
     */
    public function setMember(Member $member): Testimonial
    {
        $this->member = $member;
        return $this;
    }
}
