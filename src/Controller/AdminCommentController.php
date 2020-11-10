<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentChosenType;
use App\Repository\CommentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comment")
 */
class AdminCommentController extends AbstractController
{
    public function chooseComment(CommentRepository $commentRepository, Request $request, $formChosenComment, $comment)
    {
        $formChosenComment->handleRequest($request);
        if ($formChosenComment->isSubmitted() && $formChosenComment->isValid()) {
            if ($comment->getChosenComment() === true) {
                $this->addFlash(
                    'success',
                    'Le commentaire a été mis en avant et sera affiché sur la page de l\'article');
                $this->getDoctrine()->getManager()->flush();
            } else {
                    $this->addFlash('danger', "Le commentaire a été retiré de l'article");
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_comment_index');
            }
        }
    }

    /**
     * @Route("/", name="admin_comment_index", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN", message="Vous devez vous connecter pour accéder à cette page.")
     * @param CommentRepository $commentRepository
     * @return Response
     */
    public function index(CommentRepository $commentRepository, Request $request): Response
    {
        /**
         * @var FormFactory
         */
        $formFactory = $this->get('form.factory');
        $comments = $commentRepository->findCommentsByDate();
        $viewsChosenComment = [];

        foreach ($comments as $key => $comment)
        {
            $formChosenComment = $formFactory->createNamed('comment_chosen_' . $key, CommentChosenType::class, $comment);
            $this->chooseComment($commentRepository, $request, $formChosenComment, $comment);
            $viewsChosenComment[] = $formChosenComment->createView();
        }

        return $this->render('admin_comment/index.html.twig', [
            'comments' => $comments,
            'formChosenComment' => $viewsChosenComment,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_comment_show", methods={"GET"})
     * @param Comment $comment
     * @return Response
     */
    public function show(Comment $comment): Response
    {
        return $this->render('admin_comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_comment_delete", methods={"DELETE"})
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Le commentaire a été supprimé.'
            );
        }

        return $this->redirectToRoute('admin_comment_index');
    }
}
