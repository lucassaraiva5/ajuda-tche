<?php

namespace App\Controller;

use App\Entity\ProdutoPosto;
use App\Form\ProdutoPostoType;
use App\Repository\PostoColetaRepository;
use App\Repository\ProdutoPostoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/admin/produto-posto')]
class ProdutoPostoController extends AbstractController
{
    #[Route('/', name: 'app_produto_posto_index', methods: ['GET'])]
    public function index(ProdutoPostoRepository $produtoPostoRepository, #[MapQueryParameter] ?int $page = 0, #[MapQueryParameter] ?string $search, Security $security, PostoColetaRepository $postoColetaRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $security->getUser();
        $posto = $postoColetaRepository->findOneByUsuario($user);

        $queryBuilder = $produtoPostoRepository->createQueryBuilder('a')
            ->select('a');

        if(!$user->hasRole('ROLE_ADMIN')) {
            $queryBuilder->where('a.posto = :posto')
            ->setParameter('posto', $posto);
        }

        if(!empty($search) && !is_null($search)) {
            $queryBuilder->where(
                $queryBuilder->expr()->like('a.nome', ':search')
            )
            ->setParameter('search', '%' . $search . '%');
        }

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        if(is_null($page)) {
            $page = 1;
        }
        $pagerfanta->setCurrentPage($page);

        return $this->render('produto_posto/index.html.twig', [
            'pager' => $pagerfanta,
        ]);
    }

    #[Route('/new', name: 'app_produto_posto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security, PostoColetaRepository $postoColetaRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $security->getUser();

        $posto = $postoColetaRepository->findOneByUsuario($user);

        $produtoPosto = new ProdutoPosto();
        $form = $this->createForm(ProdutoPostoType::class, $produtoPosto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produtoPosto->setPosto($posto);
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
