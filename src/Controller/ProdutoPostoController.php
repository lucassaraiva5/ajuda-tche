<?php

namespace App\Controller;

use App\Entity\ProdutoPosto;
use App\Form\ProdutoPostoType;
use App\Repository\ProdutoPostoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/produto-posto')]
class ProdutoPostoController extends AbstractController
{
    #[Route('/', name: 'app_produto_posto_index', methods: ['GET'])]
    public function index(ProdutoPostoRepository $produtoPostoRepository): Response
    {
        return $this->render('produto_posto/index.html.twig', [
            'produto_postos' => $produtoPostoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produto_posto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produtoPosto = new ProdutoPosto();
        $form = $this->createForm(ProdutoPostoType::class, $produtoPosto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produtoPosto);
            $entityManager->flush();

            return $this->redirectToRoute('app_produto_posto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto_posto/new.html.twig', [
            'produto_posto' => $produtoPosto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_posto_show', methods: ['GET'])]
    public function show(ProdutoPosto $produtoPosto): Response
    {
        return $this->render('produto_posto/show.html.twig', [
            'produto_posto' => $produtoPosto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produto_posto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProdutoPosto $produtoPosto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProdutoPostoType::class, $produtoPosto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produto_posto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto_posto/edit.html.twig', [
            'produto_posto' => $produtoPosto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_posto_delete', methods: ['POST'])]
    public function delete(Request $request, ProdutoPosto $produtoPosto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produtoPosto->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($produtoPosto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produto_posto_index', [], Response::HTTP_SEE_OTHER);
    }
}
