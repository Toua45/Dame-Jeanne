<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Form\AlertType;
use App\Repository\AlertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/alerte")
 */
class AdminAlertController extends AbstractController
{
    /**
     * @Route("/editer", name="admin_alert_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $alert = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findOneBy([]);

        $form = $this->createForm(AlertType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_alert_edit');
        }

        return $this->render('admin_alert/edit.html.twig', [
            'admin_alert' => $alert,
            'form' => $form->createView(),
        ]);
    }

}
