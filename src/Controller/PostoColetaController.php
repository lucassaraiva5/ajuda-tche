<?php

namespace App\Controller;

use App\Entity\PostoColeta;
use App\Form\PostoColetaType;
use App\Repository\PostoColetaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

#[Route('/admin/posto-coleta')]
class PostoColetaController extends AbstractController
{
    #[Route('/', name: 'app_posto_coleta_index', methods: ['GET'])]
    public function index(PostoColetaRepository $postoColetaRepository, #[MapQueryParameter] ?int $page = 0, #[MapQueryParameter] ?string $search): Response
    {
        $queryBuilder = $postoColetaRepository->createQueryBuilder('a')->select('a');

        if(!empty($search) && !is_null($search)) {
            $queryBuilder->where(
                $queryBuilder->expr()->like('a.descricao', ':search')
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

        return $this->render('posto_coleta/index.html.twig', [
            'pager' => $pagerfanta,
        ]);
    }

    #[Route('/new', name: 'app_posto_coleta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postoColetum = new PostoColeta();
        $form = $this->createForm(PostoColetaType::class, $postoColetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($postoColetum);
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posto_coleta/new.html.twig', [
            'posto_coletum' => $postoColetum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posto_coleta_show', methods: ['GET'])]
    public function show(PostoColeta $postoColetum): Response
    {
        return $this->render('posto_coleta/show.html.twig', [
            'posto_coletum' => $postoColetum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_posto_coleta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostoColeta $postoColetum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostoColetaType::class, $postoColetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posto_coleta/edit.html.twig', [
            'posto_coletum' => $postoColetum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posto_coleta_delete', methods: ['POST'])]
    public function delete(Request $request, PostoColeta $postoColetum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postoColetum->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($postoColetum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posto_coleta_index', [], Response::HTTP_SEE_OTHER);
    }
}
