<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use App\Repository\PartnerRepository;
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
     * @param PartnerRepository $partnerRepository
     */
    public function index(TeamRepository $teamRepository, MessageRepository $messageRepository, PartnerRepository $partnerRepository)
    {
        $teams = $teamRepository->findAll();
        $messages = $messageRepository->findAll();
        $partners = $partnerRepository->findBy([], ['updatedAt' => 'DESC'], 10);

        return $this->render('presentation/index.html.twig', [
            'teams' => $teams,
            'messages' => $messages,
            'partners' => $partners,
        ]);
    }
}
