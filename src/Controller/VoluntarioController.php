<?php

namespace App\Controller;

use App\Entity\Voluntario;
use App\Form\VoluntarioType;
use App\Repository\VoluntarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/voluntario')]
class VoluntarioController extends AbstractController
{
    #[Route('/', name: 'app_voluntario_index', methods: ['GET'])]
    public function index(VoluntarioRepository $voluntarioRepository): Response
    {
        return $this->render('voluntario/index.html.twig', [
            'voluntarios' => $voluntarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voluntario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voluntario = new Voluntario();
        $form = $this->createForm(VoluntarioType::class, $voluntario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voluntario);
            $entityManager->flush();

            return $this->redirectToRoute('app_voluntario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voluntario/new.html.twig', [
            'voluntario' => $voluntario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voluntario_show', methods: ['GET'])]
    public function show(Voluntario $voluntario): Response
    {
        return $this->render('voluntario/show.html.twig', [
            'voluntario' => $voluntario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voluntario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voluntario $voluntario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoluntarioType::class, $voluntario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voluntario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voluntario/edit.html.twig', [
            'voluntario' => $voluntario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voluntario_delete', methods: ['POST'])]
    public function delete(Request $request, Voluntario $voluntario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voluntario->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($voluntario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voluntario_index', [], Response::HTTP_SEE_OTHER);
    }
}
