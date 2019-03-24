<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;
use App\Repository\NewsRepository;

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
     * @Route("/news/{id}", name="news_show")
     */
    public function show(News $article) {
        return $this->render('news/show.html.twig', [
            'article' => $article
        ]);
    }
}
