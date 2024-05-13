<?php

namespace App\Controller;

use App\Entity\UnidadeArmazenamento;
use App\Form\UnidadeArmazenamentoType;
use App\Repository\UnidadeArmazenamentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/unidade-armazenamento')]
class UnidadeArmazenamentoController extends AbstractController
{
    #[Route('/', name: 'app_unidade_armazenamento_index', methods: ['GET'])]
    public function index(UnidadeArmazenamentoRepository $unidadeArmazenamentoRepository): Response
    {
        return $this->render('unidade_armazenamento/index.html.twig', [
            'unidade_armazenamentos' => $unidadeArmazenamentoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_unidade_armazenamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unidadeArmazenamento = new UnidadeArmazenamento();
        $form = $this->createForm(UnidadeArmazenamentoType::class, $unidadeArmazenamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($unidadeArmazenamento);
            $entityManager->flush();

            return $this->redirectToRoute('app_unidade_armazenamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unidade_armazenamento/new.html.twig', [
            'unidade_armazenamento' => $unidadeArmazenamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unidade_armazenamento_show', methods: ['GET'])]
    public function show(UnidadeArmazenamento $unidadeArmazenamento): Response
    {
        return $this->render('unidade_armazenamento/show.html.twig', [
            'unidade_armazenamento' => $unidadeArmazenamento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_unidade_armazenamento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UnidadeArmazenamento $unidadeArmazenamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UnidadeArmazenamentoType::class, $unidadeArmazenamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_unidade_armazenamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unidade_armazenamento/edit.html.twig', [
            'unidade_armazenamento' => $unidadeArmazenamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unidade_armazenamento_delete', methods: ['POST'])]
    public function delete(Request $request, UnidadeArmazenamento $unidadeArmazenamento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidadeArmazenamento->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($unidadeArmazenamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_unidade_armazenamento_index', [], Response::HTTP_SEE_OTHER);
    }
}
