<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/partner")
 */
class AdminPartnerController extends AbstractController
{
    /**
     * @Route("/", name="admin_partner_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", message="Vous devez vous connecter pour accéder à cette page.")
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('admin_partner/index.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_partner_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partner);
            $entityManager->flush();

            return $this->redirectToRoute('admin_partner_index');
        }

        return $this->render('admin_partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_partner_show", methods={"GET"})
     */
    public function show(Partner $partner): Response
    {
        return $this->render('admin_partner/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_partner_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Partner $partner): Response
    {
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_partner_index');
        }

        return $this->render('admin_partner/edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Partner $partner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_partner_index');
    }
}
