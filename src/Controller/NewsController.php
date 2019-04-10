<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Entity\Comment;
use App\Form\CommentType;

use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(NewsRepository $repo)
    {
        $articles = $repo->findAll();
        
        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('news/home.html.twig');
    }

    /**
     * @Route("admin/news/new", name="news_create")
     * @Route("admin/news/{id}/{title}/edit", name="news_edit")
     */
    public function form(News $article = null, Request $request, ObjectManager $manager) {
        if (!$article) {
            $article = new News();
        }

        $form = $this->createForm(NewsType::class, $article);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('news_show', [
                'id' => $article->getId(),
                'title' => $article->getSlug()
            ]);
        }

        return $this->render('admin/create.html.twig', [
            'formNews' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("admin/news/{id}/{title}/delete", name="news_delete")
     */
    public function delete(News $article, objectManager $manager) {
        $manager->remove($article);
        $manager->flush();

        return $this->redirectToRoute('news');
    }

    /**
     * @Route("/news/{id}/{title}", name="news_show")
     */
    public function show(News $article, Request $request, ObjectManager $manager) {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime)
                    ->setNews($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('news_show', [
                'id' => $article->getId(),
                'title' => $article->getSlug('title')
            ]);
        }

        return $this->render('news/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}
