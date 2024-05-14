<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoSearchType;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use App\Service\ProdutoService;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/produto')]
class ProdutoController extends AbstractController
{
    #[Route('/', name: 'app_produto_index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProdutoRepository $produtoRepository, #[MapQueryParameter] ?int $page = 0, #[MapQueryParameter] ?string $search, ProdutoService $produtoService): Response
    {
        $queryBuilder = $produtoRepository->createQueryBuilder('a')->select('a');

        $produto = new Produto();
        $form = $this->createForm(ProdutoSearchType::class, $produto);

        $queryBuilder = $produtoService->produtoFilter($request, $form, $queryBuilder);

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        if(is_null($page)) {
            $page = 1;
        }
        $pagerfanta->setCurrentPage($page);

        return $this->render('produto/index.html.twig', [
            'pager' => $pagerfanta,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_produto_new', methods: ['GET', 'POST'])]
    #[IsGranted('PRODUTO_ADD')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($produto);
            $entityManager->flush();

            return $this->redirectToRoute('app_produto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto/new.html.twig', [
            'produto' => $produto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_show', methods: ['GET'])]
    public function show(Produto $produto): Response
    {
        return $this->render('produto/show.html.twig', [
            'produto' => $produto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produto_edit', methods: ['GET', 'POST'])]
    #[IsGranted('PRODUTO_EDIT')]
    public function edit(Request $request, Produto $produto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Registro salvo com sucesso!');

            return $this->redirectToRoute('app_produto_edit', ['id'=> $produto->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produto/edit.html.twig', [
            'produto' => $produto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produto_delete', methods: ['POST'])]
    #[IsGranted('PRODUTO_DELETE')]
    public function delete(Request $request, Produto $produto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produto->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($produto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produto_index', [], Response::HTTP_SEE_OTHER);
    }
}
