<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    const NB_MAX_ARTICLES = 6;

    /**
     * @Route("/{page}", name="blog_index", methods={"GET"}, requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function index(ArticleRepository $articleRepository, Request $request, int $page)
    {
        $form = $this->get('form.factory')->createNamed('', ArticleSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $category = $data['category'];
            $articles = $articleRepository->findLikeName($search, $category, $page);
        } else {
            $articles = $articleRepository->findAllSortAndPage($page);
        }

        $nbArticles = count($articleRepository->findAllSortAndPage());
        $currentPage = $page;

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'currentPage' => $currentPage,
            'maxPages' => (int)ceil($nbArticles/self::NB_MAX_ARTICLES),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show-article/{slug}", name="blog_show")
     */
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
