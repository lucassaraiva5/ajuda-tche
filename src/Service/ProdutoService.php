<?php

namespace App\Service;

use App\Entity\ProdutoPosto;
use App\Entity\Usuario;
use App\Repository\PostoAjudaRepository;
use App\Repository\ProdutoPostoRepository;
use App\Repository\ProdutoRepository;
use App\Repository\TipoUnidadeRepository;
use App\Repository\UnidadeConversaoRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ProdutoService
{
    public function __construct(
        private ProdutoPostoRepository $produtoPostoRepository,
        private ProdutoRepository $produtoRepository,
        private PostoAjudaRepository $postoAjudaRepository,
        private EntityManagerInterface $entityManager,
        private TipoUnidadeRepository $tipoUnidadeRepository,
        private UnidadeConversaoRepository $unidadeConversaoRepository,
        private Security $security,
    ) {
    }

    public function adicionaEmProdutoPostoExistente(ProdutoPosto $produtoPosto, array $data)
    {
        $user = $this->security->getUser();
        $postoAjuda = $user->getPostoAjuda();

        $tipoUnidade = $this->tipoUnidadeRepository->find($data["produto_posto"]["tipoUnidade"]);

        $unidadeMultiplicador = 1;
        if(isset($data["produto_posto"]["unidadeConversao"])) {
            $unidadeConversao = $this->unidadeConversaoRepository->find($data["produto_posto"]["unidadeConversao"]);
            $unidadeMultiplicador = $unidadeConversao->getValor();
        }

        $produtoPostoExistente = $this->produtoPostoRepository->findOneBy(['produto' => $produtoPosto->getProduto(), 'posto' => $postoAjuda]);

        if($produtoPostoExistente) {
            $valorExistente = $produtoPostoExistente->getQuantidade();
            $valorAdicionado = intval($produtoPosto->getQuantidade()) * $tipoUnidade->getValor() * $unidadeMultiplicador;
            $valorTotal = floatval($valorExistente) + ($valorAdicionado);
            $produtoPostoExistente->setQuantidade($valorTotal);

            $this->entityManager->persist($produtoPostoExistente);
        }else {
            $produtoPosto->setPosto($postoAjuda);
            $valorAdicionado = intval($produtoPosto->getQuantidade()) * $tipoUnidade->getValor() * $unidadeMultiplicador;
            $produtoPosto->setQuantidade($valorAdicionado);

            $this->entityManager->persist($produtoPosto);
        }
        $this->entityManager->flush();
    }

    public function produtoFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->request->all();
            

            if(isset($params["produto_search"]["descricao"]) && !empty($params["produto_search"]["descricao"])) {
                $queryBuilder->where(
                    $queryBuilder->expr()->like('a.descricao', ':search')
                )
                ->setParameter('search', "%{$params["produto_search"]["descricao"]}%");
            }

            if(isset($params["produto_search"]["categoria"]) && !empty($params["produto_search"]["categoria"])){

                $queryBuilder->andWhere('a.categoria = :id')
                ->setParameter('id', $params["produto_search"]["categoria"]);
            }
            
        }

        return $queryBuilder;
    }

    public function produtoPostoFilter(Request $request, FormInterface $form, QueryBuilder $queryBuilder): QueryBuilder
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $params = $request->request->all();
            
            $queryBuilder
                ->leftJoin('a.produto', 'produto')
                ->leftJoin('produto.categoria', 'categoria');

            if(isset($params["produto_search"]["descricao"]) && !empty($params["produto_search"]["descricao"])) {
                $queryBuilder->andWhere(
                        $queryBuilder->expr()->like('produto.descricao', ':search')
                    )
                    ->setParameter('search', "%{$params["produto_search"]["descricao"]}%");
            }

            if(isset($params["produto_search"]["categoria"]) && !empty($params["produto_search"]["categoria"])){
                $queryBuilder
                    ->andWhere('categoria.id = :id')
                    ->setParameter('id', $params["produto_search"]["categoria"]);
            }
            
        }

        return $queryBuilder;
    }

    // public function conversaoParaUnidadeArmazenamento(ProdutoPosto $produtoPosto, ?ProdutoPosto $produtoPostoExistente = null): ProdutoPosto
    // {
    //     $unidadeConversao = $produtoPosto->getProduto()->getUnidadeArmazenamento();

    //     $produtoPosto->getQuantidade();


    //     return $produtoPosto;
    // }

}
