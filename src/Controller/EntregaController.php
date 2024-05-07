<?php

namespace App\Controller;

use App\Entity\Entrega;
use App\Form\EntregaType;
use App\Repository\EntregaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entrega')]
class EntregaController extends AbstractController
{
    #[Route('/', name: 'app_entrega_index', methods: ['GET'])]
    public function index(EntregaRepository $entregaRepository): Response
    {
        return $this->render('entrega/index.html.twig', [
            'entregas' => $entregaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entrega_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entrega = new Entrega();
        $form = $this->createForm(EntregaType::class, $entrega);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entrega);
            $entityManager->flush();

            return $this->redirectToRoute('app_entrega_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entrega/new.html.twig', [
            'entrega' => $entrega,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrega_show', methods: ['GET'])]
    public function show(Entrega $entrega): Response
    {
        return $this->render('entrega/show.html.twig', [
            'entrega' => $entrega,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entrega_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entrega $entrega, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntregaType::class, $entrega);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entrega_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entrega/edit.html.twig', [
            'entrega' => $entrega,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrega_delete', methods: ['POST'])]
    public function delete(Request $request, Entrega $entrega, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrega->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($entrega);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entrega_index', [], Response::HTTP_SEE_OTHER);
    }
}
