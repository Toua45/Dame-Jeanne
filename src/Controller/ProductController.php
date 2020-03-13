<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    const NB_MAX_PRODUCTS = 9;

    /**
     * @Route("/{page}", name="product_index", methods={"GET"}, requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function index(ProductRepository $productRepository,  Request $request, int $page)
    {

        $form = $this->get('form.factory')->createNamed('', ProductSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $section = $data['section'];
            $products = $productRepository->findLikeName($search, $section);
        } else {
            $products = $productRepository->findAllSortAndPage($page);
        }

        $nbProducts = count($productRepository->findAllSortAndPage());

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'page' => $page,
            'nbPages' => ceil($nbProducts/self::NB_MAX_PRODUCTS),
            'form' => $form->createView(),
        ]);
    }
}
