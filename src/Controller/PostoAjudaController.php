<?php

namespace App\Controller;

use App\Entity\PostoAjuda;
use App\Form\PostoAjudaType;
use App\Repository\PostoAjudaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/posto/ajuda')]
class PostoAjudaController extends AbstractController
{
    #[Route('/', name: 'app_posto_ajuda_index', methods: ['GET'])]
    public function index(PostoAjudaRepository $postoAjudaRepository): Response
    {
        return $this->render('posto_ajuda/index.html.twig', [
            'posto_ajudas' => $postoAjudaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_posto_ajuda_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $postoAjuda = new PostoAjuda();
        $form = $this->createForm(PostoAjudaType::class, $postoAjuda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($postoAjuda);
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_ajuda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posto_ajuda/new.html.twig', [
            'posto_ajuda' => $postoAjuda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posto_ajuda_show', methods: ['GET'])]
    public function show(PostoAjuda $postoAjuda): Response
    {
        return $this->render('posto_ajuda/show.html.twig', [
            'posto_ajuda' => $postoAjuda,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_posto_ajuda_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostoAjuda $postoAjuda, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostoAjudaType::class, $postoAjuda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_posto_ajuda_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posto_ajuda/edit.html.twig', [
            'posto_ajuda' => $postoAjuda,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posto_ajuda_delete', methods: ['POST'])]
    public function delete(Request $request, PostoAjuda $postoAjuda, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postoAjuda->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($postoAjuda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posto_ajuda_index', [], Response::HTTP_SEE_OTHER);
    }
}
