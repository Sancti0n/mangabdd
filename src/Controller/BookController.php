<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    public function index(BookRepository $repo) {
        $book = $repo->findAll();

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'book' => $book
        ]);
    }

    /**
     * @Route("/books/{id}", name="book_id")
     */
    public function showBook(Book $book) {
        return $this->render('book/showBook.html.twig', [
            'book' => $book
        ]);
    }
}
