<?php

namespace App\Controller;

use App\Entity\Porfolio;
use App\Form\PorfolioType;
use App\Repository\PorfolioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/portfolio')]
class PorfolioController extends AbstractController
{
    #[Route('/', name: 'app_porfolio_index', methods: ['GET'])]
    public function index(PorfolioRepository $porfolioRepository): Response
    {
        return $this->render('admin/porfolio/index.html.twig', [
            'portfolios' => $porfolioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_porfolio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PorfolioRepository $porfolioRepository): Response
    {
        $porfolio = new Porfolio();
        $form = $this->createForm(PorfolioType::class, $porfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $porfolioRepository->add($porfolio);
            return $this->redirectToRoute('app_porfolio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/porfolio/new.html.twig', [
            'porfolio' => $porfolio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_porfolio_show', methods: ['GET'])]
    public function show(Porfolio $porfolio): Response
    {
        return $this->render('admin/porfolio/show.html.twig', [
            'porfolio' => $porfolio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_porfolio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Porfolio $porfolio, PorfolioRepository $porfolioRepository): Response
    {
        $form = $this->createForm(PorfolioType::class, $porfolio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $porfolioRepository->add($porfolio);
            return $this->redirectToRoute('app_porfolio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/porfolio/edit.html.twig', [
            'porfolio' => $porfolio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_porfolio_delete', methods: ['POST'])]
    public function delete(Request $request, Porfolio $porfolio, PorfolioRepository $porfolioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$porfolio->getId(), $request->request->get('_token'))) {
            $porfolioRepository->remove($porfolio);
        }

        return $this->redirectToRoute('app_porfolio_index', [], Response::HTTP_SEE_OTHER);
    }
}
