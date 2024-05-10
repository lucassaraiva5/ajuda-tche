<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;


#[Route('/categoria')]
class CategoriaController extends AbstractController
{
    #[Route('/', name: 'app_categoria_index', methods: ['GET'])]
    public function index(CategoriaRepository $categoriaRepository, #[MapQueryParameter] ?int $page = 0, #[MapQueryParameter] ?string $search): Response
    {
        $queryBuilder = $categoriaRepository->createQueryBuilder('a')->select('a');

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

        return $this->render('categoria/index.html.twig', [
            'pager' => $pagerfanta,
        ]);
    }

    #[Route('/new', name: 'app_categoria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorium = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorium);
            $entityManager->flush();

            return $this->redirectToRoute('app_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categoria/new.html.twig', [
            'categorium' => $categorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoria_show', methods: ['GET'])]
    public function show(Categoria $categorium): Response
    {
        return $this->render('categoria/show.html.twig', [
            'categorium' => $categorium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categoria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoria $categorium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categoria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categoria/edit.html.twig', [
            'categorium' => $categorium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoria_delete', methods: ['POST'])]
    public function delete(Request $request, Categoria $categorium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorium->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($categorium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
