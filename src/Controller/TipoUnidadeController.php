<?php

namespace App\Controller;

use App\Entity\TipoUnidade;
use App\Form\TipoUnidadeType;
use App\Repository\TipoUnidadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/tipo-unidade')]
class TipoUnidadeController extends AbstractController
{
    #[Route('/', name: 'app_tipo_unidade_index', methods: ['GET'])]
    public function index(TipoUnidadeRepository $tipoUnidadeRepository): Response
    {
        return $this->render('tipo_unidade/index.html.twig', [
            'tipo_unidades' => $tipoUnidadeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tipo_unidade_new', methods: ['GET', 'POST'])]
    #[IsGranted('TIPO_UNIDADE_ADD')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tipoUnidade = new TipoUnidade();
        $form = $this->createForm(TipoUnidadeType::class, $tipoUnidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoUnidade);
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_unidade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_unidade/new.html.twig', [
            'tipo_unidade' => $tipoUnidade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_unidade_show', methods: ['GET'])]
    #[IsGranted('TIPO_UNIDADE_ADD')]
    public function show(TipoUnidade $tipoUnidade): Response
    {
        return $this->render('tipo_unidade/show.html.twig', [
            'tipo_unidade' => $tipoUnidade,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tipo_unidade_edit', methods: ['GET', 'POST'])]
    #[IsGranted('TIPO_UNIDADE_EDIT')]
    public function edit(Request $request, TipoUnidade $tipoUnidade, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TipoUnidadeType::class, $tipoUnidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tipo_unidade_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tipo_unidade/edit.html.twig', [
            'tipo_unidade' => $tipoUnidade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tipo_unidade_delete', methods: ['POST'])]
    #[IsGranted('TIPO_UNIDADE_DELETE')]
    public function delete(Request $request, TipoUnidade $tipoUnidade, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoUnidade->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($tipoUnidade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tipo_unidade_index', [], Response::HTTP_SEE_OTHER);
    }
}
