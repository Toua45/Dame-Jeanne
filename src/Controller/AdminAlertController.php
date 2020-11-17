<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Form\AlertType;
use App\Repository\AlertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/alert")
 */
class AdminAlertController extends AbstractController
{
    public function chooseAlert(AlertRepository $alertRepository, Request $request, $formChosenAlert, $alert)
    {
        $formChosenAlert->handleRequest($request);
        if ($formChosenAlert->isSubmitted() && $formChosenAlert->isValid()) {
            if ($alert->getActivated() === true) {
                $this->addFlash(
                    'success',
                    'Le message d\'alerte est bien affiché.');
                $this->getDoctrine()->getManager()->flush();
            } else {
                $this->addFlash('danger', 'Le message d\'alerte a bien été désactivé.');
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin_alert_index');
            }
        }
    }

    /**
     * @Route("/", name="admin_alert_index", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN", message="Vous devez vous connecter pour accéder à cette page.")
     * @param AlertRepository $alertRepository
     * @return Response
     */
    public function index(AlertRepository $alertRepository, Request $request): Response
    {
        /**
         * @var FormFactory
         */
        $form = $this->get('form.factory');
        $alerts = $alertRepository->findAll();
        $viewsChosenAlert = [];

        foreach ($alerts as $key => $alert)
        {
            $formChosenAlert = $form->createNamed('alert_activation_' . $key, AlertType::class, $alert);
            $this->chooseAlert($alertRepository, $request, $formChosenAlert, $alert);
            $viewsChosenAlert[] = $formChosenAlert->createView();
        }

        return $this->render('admin_alert/index.html.twig', [
            'alerts' => $alerts,
            'formChosenAlert' => $viewsChosenAlert
        ]);
    }

    /**
     * @Route("/new", name="admin_alert_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $alert = new Alert();
        $form = $this->createForm(AlertType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alert);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Votre message a bien été ajouté'
            );

            return $this->redirectToRoute('admin_alert_index');
        }

        return $this->render('admin_alert/new.html.twig', [
            'alert' => $alert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_alert_show", methods={"GET"})
     */
    public function show(Alert $alert): Response
    {
        return $this->render('admin_alert/show.html.twig', [
            'alert' => $alert,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_alert_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alert $alert): Response
    {
        $form = $this->createForm(AlertType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success', 'Votre message a bien été modifié'
            );

            return $this->redirectToRoute('admin_alert_index');
        }

        return $this->render('admin_alert/edit.html.twig', [
            'alert' => $alert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_alert_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Alert $alert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alert->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alert);
            $entityManager->flush();

            $this->addFlash(
                'danger', 'Votre message a bien été supprimé'
            );
        }

        return $this->redirectToRoute('admin_alert_index');
    }
}
