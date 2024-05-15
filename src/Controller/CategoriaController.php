<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaSearchType;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use App\Service\CategoriaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/categoria')]
class CategoriaController extends BaseController
{
    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
        $this->searchTypeClass = CategoriaSearchType::class;
        $this->entityView = 'categoria';
        $this->entitySearch = new Categoria();
    }

    #[Route('/', name: 'app_categoria_index', methods: ['GET'])]
    public function index(Request $request, CategoriaRepository $categoriaRepository, #[MapQueryParameter] ?int $page = 0, CategoriaService $categoriaService): Response
    {
        return $this->view(
            repository: $categoriaRepository,
            page: $page,
            request: $request,
            filterPostoAdmin: false,
            usuario: $this->user,
            service: $categoriaService,
            filterMethod: 'categoriaFilter');

    }

    #[Route('/new', name: 'app_categoria_new', methods: ['GET', 'POST'])]
    #[IsGranted('CATEGORIA_ADD')]
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
    #[IsGranted('CATEGORIA_EDIT')]
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
    #[IsGranted('CATEGORIA_DELETE')]
    public function delete(Request $request, Categoria $categorium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorium->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($categorium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categoria_index', [], Response::HTTP_SEE_OTHER);
    }
}
