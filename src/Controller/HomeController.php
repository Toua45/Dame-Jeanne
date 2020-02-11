<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository, Request $request, MailerInterface $mailer)
    {


        $articles = $articleRepository->findBy([], ['date' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
