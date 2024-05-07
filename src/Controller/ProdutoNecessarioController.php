<?php

namespace App\Controller;

use App\Entity\ProdutoNecessario;
use App\Form\ProdutoNecessarioType;
use App\Repository\ProdutoNecessarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/produto-necessario')]
class ProdutoNecessarioController extends AbstractController
{
    #[Route('/', name: 'app_produto_necessario_index', methods: ['GET'])]
    public function index(ProdutoNecessarioRepository $produtoNecessarioRepository): Response
    {
        return $this->render('produto_necessario/index.html.twig', [
            'produto_necessarios' => $produtoNecessarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produto_necessario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produtoNecessario = new ProdutoNecessario();
        $form = $this->createForm(ProdutoNecessarioType::class, $produtoNecessario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produtoNecessario);
            $entityManager->flush();

            return $this->redirectToRoute('app_produto_necessario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto_necessario/new.html.twig', [
            'produto_necessario' => $produtoNecessario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_necessario_show', methods: ['GET'])]
    public function show(ProdutoNecessario $produtoNecessario): Response
    {
        return $this->render('produto_necessario/show.html.twig', [
            'produto_necessario' => $produtoNecessario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produto_necessario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProdutoNecessario $produtoNecessario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProdutoNecessarioType::class, $produtoNecessario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produto_necessario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto_necessario/edit.html.twig', [
            'produto_necessario' => $produtoNecessario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_necessario_delete', methods: ['POST'])]
    public function delete(Request $request, ProdutoNecessario $produtoNecessario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produtoNecessario->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($produtoNecessario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produto_necessario_index', [], Response::HTTP_SEE_OTHER);
    }
}
