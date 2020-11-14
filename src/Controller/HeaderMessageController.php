<?php

namespace App\Controller;

use App\Entity\Alert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HeaderMessageController extends AbstractController
{
    /**
     * @Route("/header/message", name="header_message")
     */
    public function getHeaderMessage()
    {
        $alerts = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findAll();

        return $this->render('_alert_message.html.twig', [
            'alerts' => $alerts,
        ]);
    }
}
