<?php

namespace App\Service;

use App\Service\Interfaces\AppServiceInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class UnidadeConversaoService implements AppServiceInterface
{
    public function __construct(
    ) {
    }

    public function unidadeConversaoFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->query->all();
            
            if(isset($params["unidade_conversao_search"]["descricao"]) && !empty($params["unidade_conversao_search"]["descricao"])) {
                $queryBuilder->where(
                    $queryBuilder->expr()->like('a.descricao', ':search')
                )
                ->setParameter('search', "%{$params["unidade_conversao_search"]["descricao"]}%");
            }

            if(isset($params["unidade_conversao_search"]["valor"]) && !empty($params["unidade_conversao_search"]["valor"])) {
                $queryBuilder->where('a.valor = :valor')
                ->setParameter('valor', "%{$params["unidade_conversao_search"]["valor"]}%");
            }
            
        }

        return $queryBuilder;
    }

}
