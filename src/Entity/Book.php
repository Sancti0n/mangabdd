<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="string")
     */
    private $isbn10;

    /**
     * @ORM\Column(type="string")
     */
    private $isbn13;

    /**
     * @ORM\Column(type="integer")
     */
    private $ntitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rightholderPublisher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $legalDeposit;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserBook", mappedBy="idBook")
     */
    private $userBooks;

    public function __construct()
    {
        $this->userBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getIsbn10(): ?int
    {
        return $this->isbn10;
    }

    public function setIsbn10(int $isbn10): self
    {
        $this->isbn10 = $isbn10;

        return $this;
    }

    public function getIsbn13(): ?int
    {
        return $this->isbn13;
    }

    public function setIsbn13(int $isbn13): self
    {
        $this->isbn13 = $isbn13;

        return $this;
    }

    public function getNtitle(): ?int
    {
        return $this->ntitle;
    }

    public function setNtitle(int $ntitle): self
    {
        $this->ntitle = $ntitle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRightholderPublisher(): ?string
    {
        return $this->rightholderPublisher;
    }

    public function setRightholderPublisher(string $rightholderPublisher): self
    {
        $this->rightholderPublisher = $rightholderPublisher;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(?string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLegalDeposit(): ?string
    {
        return $this->legalDeposit;
    }

    public function setLegalDeposit(?string $legalDeposit): self
    {
        $this->legalDeposit = $legalDeposit;

        return $this;
    }

    /**
     * @return Collection|UserBook[]
     */
    public function getUserBooks(): Collection
    {
        return $this->userBooks;
    }

    public function addUserBook(UserBook $userBook): self
    {
        if (!$this->userBooks->contains($userBook)) {
            $this->userBooks[] = $userBook;
            $userBook->addIdBook($this);
        }

        return $this;
    }

    public function removeUserBook(UserBook $userBook): self
    {
        if ($this->userBooks->contains($userBook)) {
            $this->userBooks->removeElement($userBook);
            $userBook->removeIdBook($this);
        }

        return $this;
    }
}
