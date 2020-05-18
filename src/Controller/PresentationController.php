<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presentation")
 */
class PresentationController extends AbstractController
{
    /**
     * @Route("/", name="presentation_index")
     * @param TeamRepository $teamRepository
     */
    public function index(TeamRepository $teamRepository)
    {
        $teams = $teamRepository->findAll();

        return $this->render('presentation/index.html.twig', [
            'teams' => $teams,
        ]);
    }
}
