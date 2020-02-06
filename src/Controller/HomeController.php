<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy([], ['date' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
