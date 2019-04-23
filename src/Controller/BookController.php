<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\UserBook;

use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Repository\UserBookRepository;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/membres", name="membres")
     */
    public function listMembres(UserRepository $repo) {
        $user = $repo->findAll();

        return $this->render('book/listusers.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/membres/{id}/{username}", name="profil_membre", requirements={"title": "[a-z0-9\-]*"})
     */
    public function profil(User $user) {
        return $this->render('book/profil.html.twig', [
            'user' => $user,
            'userBook' => $user->getUserBooks()
            
        ]);
    }
    /**
     * @Route("/book/{id}/owned", name="book_owned")
     */
    public function owned(Book $book, ObjectManager $manager, UserBookRepository $repo) : Response {
        $user = $this->getUser();

        if ($book->isOwnedByUser($user)) {
            $userBooks = $repo->findOneBy([
                'user' =>  $user
            ]);
        
            $manager->remove($userBooks);
            $manager->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Livre enlevé'
            ], 200);
        }
        
        $userBooks = new Userbook;
        $userBooks->setPossessedBook($book)
                  ->setUser($user);
        $manager->persist($userBooks);
        $manager->flush();

        return $this->json([
            'code' => 200, 
            'message' => 'Livre ajouté !'
        ], 200);
    }
}
