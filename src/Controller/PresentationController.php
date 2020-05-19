<?php

namespace App\Controller;

use App\Repository\MessageRepository;
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
     * @param MessageRepository $messageRepository
     */
    public function index(TeamRepository $teamRepository, MessageRepository $messageRepository)
    {
        $teams = $teamRepository->findAll();
        $messages = $messageRepository->findAll();

        return $this->render('presentation/index.html.twig', [
            'teams' => $teams,
            'messages' => $messages,
        ]);
    }
}
