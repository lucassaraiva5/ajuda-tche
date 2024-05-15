<?php

namespace App\Controller;

use App\Entity\Interfaces\AppEntityInterface;
use App\Entity\Produto;
use App\Entity\ProdutoPosto;
use App\Form\ProdutoPostoType;
use App\Form\ProdutoSearchType;
use App\Repository\PostoAjudaRepository;
use App\Repository\ProdutoPostoRepository;
use App\Service\ProdutoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/admin/produto-posto')]
class ProdutoPostoController extends BaseController
{
    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
        $this->searchTypeClass = ProdutoSearchType::class;
        $this->entitySearch = new Produto();
        $this->entityView = "produto_posto";

    }

    #[Route('/', name: 'app_produto_posto_index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProdutoPostoRepository $produtoPostoRepository, #[MapQueryParameter] ?int $page = 0, PostoAjudaRepository $postoAjudaRepository, ProdutoService $produtoService): Response
    {
        

        return $this->view(
                    repository: $produtoPostoRepository,
                    page: $page,
                    request: $request,
                    filterPostoAdmin: true,
                    usuario: $this->user,
                    service: $produtoService,
                    filterMethod: 'produtoPostoFilter');
    }

    #[Route('/new', name: 'app_produto_posto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PostoAjudaRepository $postoAjudaRepository, ProdutoPostoRepository $produtoPostoRepository, ProdutoService $produtoService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        

        $produtoPosto = new ProdutoPosto();
        $form = $this->createForm(ProdutoPostoType::class, $produtoPosto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produtoService->adicionaEmProdutoPostoExistente($produtoPosto, $request->request->all());
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
