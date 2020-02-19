<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $articleRepository, Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', ArticleSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $category = $data['category'];
            $articles = $articleRepository->findLikeName($search, $category);
        } else {
            $articles = $articleRepository->findBy([], ['date' => 'DESC']);
        }
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/show-article/{id}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
