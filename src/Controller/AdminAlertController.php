<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Form\Alert1Type;
use App\Repository\AlertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin_alert")
 */
class AdminAlertController extends AbstractController
{
    /**
     * @Route("/", name="admin_alert_index", methods={"GET"})
     */
    public function index(AlertRepository $alertRepository): Response
    {
        return $this->render('admin_alert/index.html.twig', [
            'alerts' => $alertRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="alert_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $alert = new Alert();
        $form = $this->createForm(Alert1Type::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alert);
            $entityManager->flush();

            return $this->redirectToRoute('alert_index');
        }

        return $this->render('admin_alert/new.html.twig', [
            'admin_alert' => $alert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="alert_show", methods={"GET"})
     */
    public function show(Alert $alert): Response
    {
        return $this->render('admin_alert/show.html.twig', [
            'admin_alert' => $alert,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="alert_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alert $alert): Response
    {
        $form = $this->createForm(Alert1Type::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alert_index');
        }

        return $this->render('admin_alert/edit.html.twig', [
            'admin_alert' => $alert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="alert_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Alert $alert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alert->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('alert_index');
    }
}
