<?php

namespace App\Service;

use App\Entity\Entrega;
use App\Entity\ProdutoEntrega;
use App\Repository\EntregaRepository;
use App\Repository\ProdutoRepository;
use App\Repository\TipoUnidadeRepository;
use App\Repository\UnidadeConversaoRepository;
use App\Service\Interfaces\AppServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EntregaService implements AppServiceInterface
{
    public function __construct(
        private Security $security,
        private ProdutoRepository $produtoRepository,
        private TipoUnidadeRepository $tipoUnidadeRepository,
        private UnidadeConversaoRepository $unidadeConversaoRepository,
        private EntregaRepository $entregaRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function entregaFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->query->all();
            
            if(isset($params["entrega_search"]["motorista"]) && !empty($params["entrega_search"]["motorista"])) {
                $queryBuilder->leftJoin('a.motorista', 'motorista')
                ->where(
                    $queryBuilder->expr()->like('motorista.nome', ':search')
                )
                ->setParameter('search', "%{$params["entrega_search"]["motorista"]}%");
            }

            if(isset($params["entrega_search"]["postoAjudaDestino"]) && !empty($params["entrega_search"]["postoAjudaDestino"])) {
                $queryBuilder->where('a.postoAjudaDestino = :posto')
                ->setParameter('posto', $params["entrega_search"]["postoAjudaDestino"]);
            }
            
        }

        return $queryBuilder;
    }

    public function adicionaProdutoEntregaComConversao(Entrega $entrega, array $data): Entrega
    {
        $user = $this->security->getUser();
        $postoAjuda = $user->getPostoAjuda();

        if(isset($data["entrega"]["produtoEntregas"])) {
            foreach($data["entrega"]["produtoEntregas"] as $produtoArray) {
                $produto = $this->produtoRepository->find($produtoArray["produto"]);
                $tipoUnidade = $this->tipoUnidadeRepository->find($produtoArray["tipoUnidade"]);

                $unidadeMultiplicador = 1;
                if(isset($produtoArray["unidadeConversao"])) {
                    $unidadeConversao = $this->unidadeConversaoRepository->find($produtoArray["unidadeConversao"]);
                    $unidadeMultiplicador = $unidadeConversao->getValor();
                }

                $produtoExistente = $entrega->checkIfProdutoAlreadyAdded($produto);

                if($produtoExistente) {
                    
                    $valorExistente = $produtoExistente->getQuantidade();
                    $valorAdicionado = intval($produtoArray["quantidade"]) * $tipoUnidade->getValor() * $unidadeMultiplicador;
                    $valorTotal = floatval($valorExistente) + ($valorAdicionado);
                    $produtoExistente->setQuantidade($valorTotal);
                    $entrega->addProdutoEntrega($produtoExistente);
                } else {
                    $produtoEntrega = new ProdutoEntrega();
                    $produtoEntrega->setProduto($produto);
                    $valorAdicionado = intval($produtoArray["quantidade"]) * $tipoUnidade->getValor() * $unidadeMultiplicador;
                    $produtoEntrega->setQuantidade($valorAdicionado);
        
                    $entrega->addProdutoEntrega($produtoEntrega);
                }
            }
        }
        
        return $entrega;
    }

}
