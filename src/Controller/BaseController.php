<?php

namespace App\Controller;

use App\Entity\Interfaces\AppEntityInterface;
use App\Entity\Usuario;
use App\Repository\Interfaces\AppRepositoryInterface;
use App\Service\Interfaces\AppServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

abstract class BaseController extends AbstractController
{
    protected Usuario $user;

    protected string $entityView;

    protected string $searchTypeClass;

    protected AppEntityInterface $entitySearch;
    
    public function view (
        AppRepositoryInterface $repository,
        ?int $page,
        Request $request,
        bool $filterPostoAdmin = false,
        Usuario $usuario,
        AppServiceInterface $service, string $filterMethod): Response {
        $queryBuilder = $repository->createQueryBuilder('a')->select('a');

        if($filterPostoAdmin) {
            if(!$usuario->hasRole('ROLE_ADMIN')) {
                $queryBuilder->where('a.posto = :posto')
                ->setParameter('posto', $usuario->getPostoAjuda());
            }
        }

        $form = $this->createForm($this->searchTypeClass, $this->entitySearch, ['method'=>"GET"]);
        $queryBuilder = $service->$filterMethod($request, $form, $queryBuilder);

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        if(is_null($page)) {
            $page = 1;
        }
        $pagerfanta->setCurrentPage($page);

        return $this->render("{$this->entityView}/index.html.twig", [
            'pager' => $pagerfanta,
            'form' => $form,
        ]);
    }
   
}
