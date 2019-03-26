<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\News;
use App\Repository\NewsRepository;
use App\Form\NewsType;

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
     * @Route("/news/new", name="news_create")
     * @Route("/news/{id}/edit", name="news_edit")
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
                'id' => $article->getId()
            ]);
        }

        return $this->render('news/create.html.twig', [
            'formNews' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/news/{id}", name="news_show")
     */
    public function show(News $article) {
        return $this->render('news/show.html.twig', [
            'article' => $article
        ]);
    }
}
