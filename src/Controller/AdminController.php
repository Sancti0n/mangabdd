<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BookRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="administration")
     */
    public function index(BookRepository $repo) {
        $book = $repo->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'book' => $book
        ]);
    }

    /**
     * @Route("/admin/addbook", name="form_book")
     * @Route("admin/addbook/{id}/{title}-{ntitle}/edit", name="book_edit", requirements={"title": "[a-z0-9\-]*"})
     */
    public function formBook(Book $book = null, Request $request, ObjectManager $manager) {
        if (!$book) {
            $book = new Book();
        }
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($book);
            $manager->flush();

            return $this->redirectToRoute('book_id', [
                'id' => $book->getId(),
                'title' => $book->getSlug(),
                'ntitle' => $book->getNtitle()
            ]);
        }

        return $this->render('admin/addbook.html.twig', [
            'formBook' => $form->createView(),
            'editMode' => $book->getId() !== null
        ]);
    }
}
