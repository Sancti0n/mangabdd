<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Entity\Comment;

use App\Form\CommentType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="administration")
     */
    public function index(BookRepository $repo) {
        $book = $repo->findAll();

        return $this->render('admin/index.html.twig', [
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

    /**
     * @Route("admin/book/{id}/{title}-{ntitle}/delete", name="book_delete", requirements={"title": "[a-z0-9\-]*"})
     */
    public function delete(Book $book, objectManager $manager) {
        $manager->remove($book);
        $manager->flush();

        return $this->redirectToRoute('books');
    }

    /**
     * @Route("admin/news/comment/{id}/edit", name="comment_edit")
     */
    public function editComment(Comment $comment, Request $request, objectManager $manager) {

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('news');
        }

        return $this->render('admin/editComment.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/news/comment/{id}/delete", name="comment_delete", requirements={"title": "[a-z0-9\-]*"})
     */
    public function deleteComment(Comment $comment, objectManager $manager) {
        $manager->remove($comment);
        $manager->flush();
        
        return $this->redirectToRoute('news');
    }
}
