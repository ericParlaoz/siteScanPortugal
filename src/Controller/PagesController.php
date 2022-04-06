<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Porfolio;
use App\Form\ContactType;
use App\Repository\PorfolioRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(Request $request, SendMailService $mail, EntityManagerInterface $entityManager): Response
    {
        $client = new Contact();
        $form = $this->createForm(ContactType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();

            $entityManager->persist($client);
            $entityManager->flush();

            $mail->send(
                $contactFormData->getEmail(),
                'contact@logo-concept-host.fr',
                'vous avez reçu un email',
                'Sender : '.$contactFormData->getEmail().\PHP_EOL.


                $contactFormData->getMessage(),
                'text/plain'
            );

            $this->addFlash('success', 'Sua mensagem foi enviada');
            return $this->redirect('#contact');
        }

        return $this->render('pages/index.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/preco-visita-virtual', name: 'preco')]
    public function preco(Request $request, SendMailService $mail, EntityManagerInterface $entityManager): Response
    {
        $client = new Contact();
        $form = $this->createForm(ContactType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();


            $entityManager->persist($client);
            $entityManager->flush();

            $mail->send(
                $contactFormData->getEmail(),
                'contact@logo-concept-host.fr',
                'vous avez reçu un email',
                'Sender : '.$contactFormData->getEmail().\PHP_EOL.


                $contactFormData->getMessage(),
                'text/plain'
            );

            $this->addFlash('success', 'Sua mensagem foi enviada');
            return $this->redirect('preco-visita-virtual#contact');
        }

        return $this->render('pages/preco.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/portfolio-visita-virtual', name: 'portfolio')]
    public function portfolio(Request $request, SendMailService $mail, EntityManagerInterface $entityManager, PorfolioRepository $porfolioRepository): Response
    {

        $client = new Contact();
        $form = $this->createForm(ContactType::class, $client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();

            $entityManager->persist($client);
            $entityManager->flush();

            $mail->send(
                $contactFormData->getEmail(),
                'contact@logo-concept-host.fr',
                'vous avez reçu un email',
                'Sender : '.$contactFormData->getEmail().\PHP_EOL.


                $contactFormData->getMessage(),
                'text/plain'
            );

            $this->addFlash('success', 'Sua mensagem foi enviada');
            return $this->redirect('portfolio-visita-virtual#contact');
        }

        return $this->render('pages/portfolio.html.twig',[
            'form' => $form->createView(),
             'portfolio' => $porfolioRepository->findAll()
        ]);
    }

    #[Route('/noticia-legal', name: 'noticia-legal')]
    public function mentions(): Response
    {
        return $this->render('pages/noticia-legal.html.twig');
    }

    #[Route('/privacidade', name: 'privacidade')]
    public function privacidade(): Response
    {
        return $this->render('pages/privacidade.html.twig');
    }

    #[Route('/portfolio-visita-virtual/{id}', name: 'show_client', methods: ['GET'])]
    public function showClient(Porfolio $porfolio): Response
    {

        return $this->render('pages/showClient.html.twig', [
            'portfolio' => $porfolio
        ]);
    }
}
