<?php

namespace App\Controller;

use App\Entity\Estado;
use App\Entity\Produto;
use App\Repository\CidadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route("/cities/{id}", name: 'get_cities', methods: ['GET'])]
    public function getCities(CidadeRepository $cidadeRepository, Estado $estado): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cidades = $cidadeRepository->findByEstado($estado);
        $array = [];
        foreach($cidades as $cidade) {
            $array[] = ['name' => $cidade->getNome(), 'id' => $cidade->getId()];
        }
        return new JsonResponse($array);
    }

    #[Route("/tipoUnidades/{id}", name: 'get_tipo_unidade', methods: ['GET'])]
    public function getTiposUnidade(Produto $produto): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $tiposUnidade = $produto->getTiposUnidade();
        $array = [];
        foreach($tiposUnidade as $tipoUnidade) {
            $array[] = ['name' => $tipoUnidade->getDescricao(), 'id' => $tipoUnidade->getId()];
        }
        return new JsonResponse($array);
    }

    #[Route("/unidadesConversao/{id}", name: 'get_unidade_conversao', methods: ['GET'])]
    public function getUnidadesConversao(Produto $produto): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $unidadesConversao = $produto->getUnidadesConversao();
        $array = [];
        foreach($unidadesConversao as $unidadeConversao) {
            $array[] = ['name' => $unidadeConversao->getDescricao(), 'id' => $unidadeConversao->getId()];
        }
        return new JsonResponse($array);
    }   
}
