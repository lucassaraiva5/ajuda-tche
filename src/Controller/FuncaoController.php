<?php

namespace App\Controller;

use App\Entity\Funcao;
use App\Form\FuncaoType;
use App\Repository\FuncaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/funcao')]
class FuncaoController extends AbstractController
{
    #[Route('/', name: 'app_funcao_index', methods: ['GET'])]
    public function index(FuncaoRepository $funcaoRepository): Response
    {
        return $this->render('funcao/index.html.twig', [
            'funcaos' => $funcaoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_funcao_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $funcao = new Funcao();
        $form = $this->createForm(FuncaoType::class, $funcao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($funcao);
            $entityManager->flush();

            return $this->redirectToRoute('app_funcao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('funcao/new.html.twig', [
            'funcao' => $funcao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_funcao_show', methods: ['GET'])]
    public function show(Funcao $funcao): Response
    {
        return $this->render('funcao/show.html.twig', [
            'funcao' => $funcao,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_funcao_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Funcao $funcao, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FuncaoType::class, $funcao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_funcao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('funcao/edit.html.twig', [
            'funcao' => $funcao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_funcao_delete', methods: ['POST'])]
    public function delete(Request $request, Funcao $funcao, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$funcao->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($funcao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_funcao_index', [], Response::HTTP_SEE_OTHER);
    }
}
