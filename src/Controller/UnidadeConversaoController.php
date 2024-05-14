<?php

namespace App\Controller;

use App\Entity\UnidadeConversao;
use App\Form\UnidadeConversaoType;
use App\Repository\UnidadeConversaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/unidade-conversao')]
class UnidadeConversaoController extends BaseController
{
    public function __construct()
    {
        $this->entityView = 'unidade_conversao';
    }

    #[Route('/', name: 'app_unidade_conversao_index', methods: ['GET'])]
    public function index(Request $request, UnidadeConversaoRepository $unidadeConversaoRepository, #[MapQueryParameter] ?int $page = 1): Response
    {
        return $this->view($unidadeConversaoRepository, $page, $request);
    }

    #[Route('/new', name: 'app_unidade_conversao_new', methods: ['GET', 'POST'])]
    #[IsGranted('UNIDADE_CONVERSAO_ADD')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unidadeConversao = new UnidadeConversao();
        $form = $this->createForm(UnidadeConversaoType::class, $unidadeConversao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($unidadeConversao);
            $entityManager->flush();

            return $this->redirectToRoute('app_unidade_conversao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unidade_conversao/new.html.twig', [
            'unidade_conversao' => $unidadeConversao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unidade_conversao_show', methods: ['GET'])]
    #[IsGranted('UNIDADE_CONVERSAO_ADD')]
    public function show(UnidadeConversao $unidadeConversao): Response
    {
        return $this->render('unidade_conversao/show.html.twig', [
            'unidade_conversao' => $unidadeConversao,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_unidade_conversao_edit', methods: ['GET', 'POST'])]
    #[IsGranted('UNIDADE_CONVERSAO_EDIT')]
    public function edit(Request $request, UnidadeConversao $unidadeConversao, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UnidadeConversaoType::class, $unidadeConversao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_unidade_conversao_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unidade_conversao/edit.html.twig', [
            'unidade_conversao' => $unidadeConversao,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unidade_conversao_delete', methods: ['POST'])]
    #[IsGranted('UNIDADE_CONVERSAO_DELETE')]
    public function delete(Request $request, UnidadeConversao $unidadeConversao, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidadeConversao->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($unidadeConversao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_unidade_conversao_index', [], Response::HTTP_SEE_OTHER);
    }
}
