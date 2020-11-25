<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleSearchType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
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
            $nbArticles = count($articleRepository->findLikeName($search, $category)); // Comptage du nombre d'articles après une recherche
        } else {
            $articles = $articleRepository->findAllSortAndPage($page);
            $nbArticles = count($articleRepository->findAllSortAndPage());
        }

        $currentPage = $page;

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'currentPage' => $currentPage,
            'nbArticlePages' => (int)ceil($nbArticles/self::NB_MAX_ARTICLES),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show-article/{slug}", name="blog_show")
     * @param Article $article
     * @param $slug
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function show(Article $article, $slug, CommentRepository $commentRepository, Request $request)
    {
        // On récupère les commentaires de l'article
        $comments = $commentRepository->findChosenComment($slug);

        // On crée l'instance de "Comment"
        $comment = new Comment();

        // On crée le formulaire en utilisant "CommentType" et on lui passe l'instance
        $formComment = $this->createForm(CommentType::class, $comment);

        // On récupère les données
        $formComment->handleRequest($request);

        // On vérifie si le formulaire a été soumis et si les données sont valides
        if ($formComment->isSubmitted() && $formComment->isValid()) {
            // Hydrate notre commentaire avec l'article
            $comment->setArticle($article);

            // Hydrate notre commentaire avec la date et l'heure courant
            $comment->setDate(new \DateTime('now'));

            $doctrine = $this->getDoctrine()->getManager();

            // On hydrate notre instance comment
            $doctrine->persist($comment);

            // On écrit en base de données
            $doctrine->flush();

            // On redirige l'utilisateur
            return $this->redirectToRoute('blog_show', ['slug' => $slug]);
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'formComment' => $formComment->createView(),
        ]);
    }
}
