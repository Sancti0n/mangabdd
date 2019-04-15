<?php

namespace App\Controller;

use App\Entity\Book;

use App\Repository\BookRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    public function index(BookRepository $repo) {
        $book = $repo->findByOrder();

        return $this->render('book/index.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/books/{id}/{title}-{ntitle}", name="book_id", requirements={"title": "[a-z0-9\-]*"})
     */
    public function showBook(Book $book) {
        return $this->render('book/showBook.html.twig', [
            'book' => $book,
            'title' => $book->getSlug()
        ]);
    }
}
