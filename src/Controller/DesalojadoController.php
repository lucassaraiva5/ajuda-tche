<?php

namespace App\Controller;

use App\Entity\Desalojado;
use App\Form\DesalojadoType;
use App\Repository\DesalojadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/desalojado')]
class DesalojadoController extends AbstractController
{
    #[Route('/concluido', name: 'app_desalojado_index', methods: ['GET'])]
    public function index(DesalojadoRepository $desalojadoRepository): Response
    {
        return $this->render('desalojado/index.html.twig', [
        ]);
    }

    #[Route('/', name: 'app_desalojado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $desalojado = new Desalojado();
        $form = $this->createForm(DesalojadoType::class, $desalojado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($desalojado);
            $entityManager->flush();

            return $this->redirectToRoute('app_desalojado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('desalojado/new.html.twig', [
            'desalojado' => $desalojado,
            'form' => $form,
        ]);
    }
}
