<?php

namespace App\Controller;

use App\Entity\Pedago;
use App\Form\PedagoType;
use App\Repository\PedagoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pedago")
 */
class AdminPedagoController extends AbstractController
{
    /**
     * @Route("/", name="admin_pedago_index", methods={"GET"})
     */
    public function index(PedagoRepository $pedagoRepository): Response
    {
        return $this->render('admin_pedago/index.html.twig', [
            'pedagos' => $pedagoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_pedago_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pedago = new Pedago();
        $form = $this->createForm(PedagoType::class, $pedago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pedago);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Le mot a été ajouté'
            );

            return $this->redirectToRoute('admin_pedago_index');
        }

        return $this->render('admin_pedago/new.html.twig', [
            'pedago' => $pedago,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pedago_show", methods={"GET"})
     */
    public function show(Pedago $pedago): Response
    {
        return $this->render('admin_pedago/show.html.twig', [
            'pedago' => $pedago,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_pedago_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pedago $pedago): Response
    {
        $form = $this->createForm(PedagoType::class, $pedago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success', 'Le mot a été modifié'
            );

            return $this->redirectToRoute('admin_pedago_index');
        }

        return $this->render('admin_pedago/edit.html.twig', [
            'pedago' => $pedago,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedago_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pedago $pedago): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pedago->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pedago);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Le mot a été supprimé'
            );
        }

        return $this->redirectToRoute('admin_pedago_index');
    }
}
