<?php

namespace App\Controller;

use App\Entity\Motorista;
use App\Form\MotoristaType;
use App\Repository\MotoristaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/motorista')]
class MotoristaController extends AbstractController
{
    #[Route('/', name: 'app_motorista_index', methods: ['GET'])]
    public function index(MotoristaRepository $motoristaRepository): Response
    {
        return $this->render('motorista/index.html.twig', [
            'motoristas' => $motoristaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_motorista_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $motoristum = new Motorista();
        $form = $this->createForm(MotoristaType::class, $motoristum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($motoristum);
            $entityManager->flush();

            return $this->redirectToRoute('app_motorista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motorista/new.html.twig', [
            'motoristum' => $motoristum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motorista_show', methods: ['GET'])]
    public function show(Motorista $motoristum): Response
    {
        return $this->render('motorista/show.html.twig', [
            'motoristum' => $motoristum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_motorista_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Motorista $motoristum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MotoristaType::class, $motoristum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_motorista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motorista/edit.html.twig', [
            'motoristum' => $motoristum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motorista_delete', methods: ['POST'])]
    public function delete(Request $request, Motorista $motoristum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motoristum->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($motoristum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_motorista_index', [], Response::HTTP_SEE_OTHER);
    }
}
