<?php

namespace App\Service;

use App\Service\Interfaces\AppServiceInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoriaService implements AppServiceInterface
{
    public function __construct(
    ) {
    }

    public function categoriaFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->query->all();
            
            if(isset($params["categoria_search"]["descricao"]) && !empty($params["categoria_search"]["descricao"])) {
                $queryBuilder->where(
                    $queryBuilder->expr()->like('a.descricao', ':search')
                )
                ->setParameter('search', "%{$params["categoria_search"]["descricao"]}%");
            }
            
        }

        return $queryBuilder;
    }

}
