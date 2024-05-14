<?php

namespace App\Controller;

use App\Repository\Interfaces\AppRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

abstract class BaseController extends AbstractController
{
    protected string $entityView;
    
    public function view(AppRepositoryInterface $repository, ?string $page, Request $request): Response {
        $queryBuilder = $repository->createQueryBuilder('a')->select('a');

        if(!empty($search) && !is_null($search)) {
            $queryBuilder->where(
                $queryBuilder->expr()->like('a.nome', ':search')
            )
            ->setParameter('search', '%' . $search . '%');
        }

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        if(!$page || is_null($page) || $page === '0' || $page === 0) {
            $page = 1;
        }
        $pagerfanta->setCurrentPage($page);

        return $this->render("{$this->entityView}/index.html.twig", [
            'pager' => $pagerfanta,
        ]);
    }
   
}
