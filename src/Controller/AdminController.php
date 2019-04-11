<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="administration")
     */
    public function index() {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/addbook", name="form_book")
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

            return $this->redirectToRoute('home', [
            ]);
        }

        return $this->render('admin/addbook.html.twig', [
            'formBook' => $form->createView(),
            'editMode' => $book->getId() !== null
        ]);
    }
}
