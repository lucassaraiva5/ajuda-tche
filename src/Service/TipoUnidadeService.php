<?php

namespace App\Service;

use App\Service\Interfaces\AppServiceInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class TipoUnidadeService implements AppServiceInterface
{
    public function __construct(
    ) {
    }

    public function tipoUnidadeFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->query->all();
            
            if(isset($params["tipo_unidade_search"]["descricao"]) && !empty($params["tipo_unidade_search"]["descricao"])) {
                $queryBuilder->where(
                    $queryBuilder->expr()->like('a.descricao', ':search')
                )
                ->setParameter('search', "%{$params["tipo_unidade_search"]["descricao"]}%");
            }

            if(isset($params["tipo_unidade_search"]["valor"]) && !empty($params["tipo_unidade_search"]["valor"])) {
                $queryBuilder->where('a.valor = :valor')
                ->setParameter('valor', $params["tipo_unidade_search"]["valor"]);
            }
            
        }

        return $queryBuilder;
    }

}
