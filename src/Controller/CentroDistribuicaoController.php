<?php

namespace App\Controller;

use App\Entity\CentroDistribuicao;
use App\Form\CentroDistribuicaoType;
use App\Repository\CentroDistribuicaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/centro-distribuicao')]
class CentroDistribuicaoController extends AbstractController
{
    #[Route('/', name: 'app_centro_distribuicao_index', methods: ['GET'])]
    public function index(CentroDistribuicaoRepository $centroDistribuicaoRepository): Response
    {
        return $this->render('centro_distribuicao/index.html.twig', [
            'centro_distribuicaos' => $centroDistribuicaoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_centro_distribuicao_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $centroDistribuicao = new CentroDistribuicao();
        $form = $this->createForm(CentroDistribuicaoType::class, $centroDistribuicao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($centroDistribuicao);
            $entityManager->flush();

            return $this->redirectToRoute('app_centro_distribuicao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centro_distribuicao/new.html.twig', [
            'centro_distribuicao' => $centroDistribuicao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centro_distribuicao_show', methods: ['GET'])]
    public function show(CentroDistribuicao $centroDistribuicao): Response
    {
        return $this->render('centro_distribuicao/show.html.twig', [
            'centro_distribuicao' => $centroDistribuicao,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centro_distribuicao_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CentroDistribuicao $centroDistribuicao, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CentroDistribuicaoType::class, $centroDistribuicao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_centro_distribuicao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centro_distribuicao/edit.html.twig', [
            'centro_distribuicao' => $centroDistribuicao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centro_distribuicao_delete', methods: ['POST'])]
    public function delete(Request $request, CentroDistribuicao $centroDistribuicao, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centroDistribuicao->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($centroDistribuicao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_centro_distribuicao_index', [], Response::HTTP_SEE_OTHER);
    }
}
