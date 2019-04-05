<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Book", inversedBy="userBooks")
     */
    private $idBook;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="userBooks")
     */
    private $username;

    public function __construct()
    {
        $this->idBook = new ArrayCollection();
        $this->username = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Book[]
     */
    public function getIdBook(): Collection
    {
        return $this->idBook;
    }

    public function addIdBook(Book $idBook): self
    {
        if (!$this->idBook->contains($idBook)) {
            $this->idBook[] = $idBook;
        }

        return $this;
    }

    public function removeIdBook(Book $idBook): self
    {
        if ($this->idBook->contains($idBook)) {
            $this->idBook->removeElement($idBook);
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsername(): Collection
    {
        return $this->username;
    }

    public function addUsername(User $username): self
    {
        if (!$this->username->contains($username)) {
            $this->username[] = $username;
        }

        return $this;
    }

    public function removeUsername(User $username): self
    {
        if ($this->username->contains($username)) {
            $this->username->removeElement($username);
        }

        return $this;
    }
}
