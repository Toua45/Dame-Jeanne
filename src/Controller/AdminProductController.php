<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/product")
 */
class AdminProductController extends AbstractController
{
    /**
     * @Route("/", name="admin_product_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN", message="Vous devez vous connecter pour accéder à cette page.")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin_product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Le produit a été ajouté'
            );

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin_product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('admin_product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success', 'Le produit a été modifié'
            );

            return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin_product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();

            $this->addFlash(
                'danger', 'Le produit a été supprimé'
            );
        }

        return $this->redirectToRoute('admin_product_index');
    }

    /**
     * @Route("/export/produits", name="admin_product_export", methods={"GET"})
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function exportProduct(ProductRepository $productRepository): Response
    {
        $csv = $this->renderView('admin_product/export_product.csv.twig', [
            'products' => $productRepository->findAll(),
        ]);

        $response = new Response($csv);
        $response->setStatusCode(200);

        $response->headers->set('Content-Type', 'application/csv;charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export_products.csv"');

        return $response;
    }
}
