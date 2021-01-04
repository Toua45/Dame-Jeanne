<?php

namespace App\Controller;

use App\Entity\Footer;
use App\Form\FooterType;
use App\Repository\FooterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/footer")
 */
class AdminFooterController extends AbstractController
{
    /**
     * @Route("/", name="admin_footer_index", methods={"GET"})
     */
    public function index(FooterRepository $footerRepository): Response
    {
        return $this->render('admin_footer/index.html.twig', [
            'footers' => $footerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="footer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $footer = new Footer();
        $form = $this->createForm(FooterType::class, $footer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($footer);
            $entityManager->flush();

            return $this->redirectToRoute('footer_index');
        }

        return $this->render('admin_footer/new.html.twig', [
            'admin_footer' => $footer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_footer_show", methods={"GET"})
     */
    public function show(Footer $footer): Response
    {
        return $this->render('admin_footer/show.html.twig', [
            'admin_footer' => $footer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_footer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Footer $footer): Response
    {
        $form = $this->createForm(FooterType::class, $footer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('footer_index');
        }

        return $this->render('admin_footer/edit.html.twig', [
            'admin_footer' => $footer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="footer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Footer $footer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$footer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($footer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('footer_index');
    }
}
