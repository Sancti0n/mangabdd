<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserBookRepository")
 */
class UserBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="userBooks")
     */
    private $possessedBook;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userBooks")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPossessedBook(): ?Book
    {
        return $this->possessedBook;
    }

    public function setPossessedBook(?Book $possessedBook): self
    {
        $this->possessedBook = $possessedBook;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
