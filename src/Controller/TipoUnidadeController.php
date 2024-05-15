<?php

namespace App\Controller;

use App\Entity\TipoUnidade;
use App\Form\TipoUnidadeSearchType;
use App\Form\TipoUnidadeType;
use App\Repository\TipoUnidadeRepository;
use App\Service\CategoriaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/tipo-unidade')]
class TipoUnidadeController extends BaseController
{
    public function __construct(Security $security)
    {
        $this->entityView = 'tipo_unidade';
        $this->user = $security->getUser();
        $this->searchTypeClass = TipoUnidadeSearchType::class;
        $this->entitySearch = new TipoUnidade();

    }

    #[Route('/', name: 'app_tipo_unidade_index', methods: ['GET'])]
    public function index(Request $request, TipoUnidadeRepository $tipoUnidadeRepository, #[MapQueryParameter] ?int $page = 1, CategoriaService $categoriaService): Response
    {
        return $this->view(
            repository: $tipoUnidadeRepository,
            page: $page,
            request: $request,
            filterPostoAdmin: false,
            usuario: $this->user,
            service: $categoriaService,
            filterMethod: 'tipoUnidadeFilter');
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
