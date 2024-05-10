<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Estado;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use App\Repository\CidadeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route("/cities/{id}", name: 'get_cities', methods: ['GET'])]
    public function getCities(CidadeRepository $cidadeRepository, Estado $estado): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $cidades = $cidadeRepository->findByEstado($estado);
        $arrayCidades = [];
        foreach($cidades as $cidade) {
            $arrayCidades[] = ['name' => $cidade->getNome(), 'id' => $cidade->getId()];
        }
        return new JsonResponse($arrayCidades);
    }    
}
