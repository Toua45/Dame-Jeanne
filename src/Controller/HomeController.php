<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ArticleRepository;
use App\Repository\CoordinateRepository;
use App\Repository\FooterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(ArticleRepository $articleRepository, Request $request, MailerInterface $mailer, CoordinateRepository $coordinateRepository)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataContact = $form->getData();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_to'))
                ->subject('Vous avez reçu un nouveau message')
                ->html($this->renderView('email/_contact.html.twig', [
                    'dataContact' => $dataContact
                ]));

            $mailer->send($email);
            $this->addFlash('success', 'Votre message a été envoyé avec succès');
            return $this->redirectToRoute('home');
        }

        $articles = $articleRepository->findBy([], ['date' => 'DESC'], 3);
        $coordinates = $coordinateRepository->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(),
            'coordinates' => $coordinates,
        ]);
    }

    public function getCoordinates(CoordinateRepository $coordinateRepository)
    {
        $coordinates = $coordinateRepository->findAll();

        return $this->render('_infos_in_footer.html.twig', ['coordinates' => $coordinates]);
    }
}
