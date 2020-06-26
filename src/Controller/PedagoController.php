<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PedagoController extends AbstractController
{
    /**
     * @Route("/pedago", name="pedago_index")
     */
    public function index()
    {
        return $this->render('pedago/index.html.twig', [
            'controller_name' => 'PedagoController',
        ]);
    }
}
