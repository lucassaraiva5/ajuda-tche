<?php

namespace App\Service;

use App\Entity\Entrega;
use App\Entity\ProdutoEntrega;
use App\Repository\EntregaRepository;
use App\Repository\ProdutoPostoRepository;
use App\Repository\ProdutoRepository;
use App\Repository\TipoUnidadeRepository;
use App\Repository\UnidadeConversaoRepository;
use App\Service\Interfaces\AppServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ProdutoPostoService implements AppServiceInterface
{
    public function __construct(
        private Security $security,
        private ProdutoRepository $produtoRepository,
        private ProdutoPostoRepository $produtoPostoRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * Esta função serve para dar baixa no estoque dos produtos
     * do estoque do posto de ajuda
     *
     * @param Entrega $entrega
     * @return void
     */
    public function removeItensDoEstoque(Entrega $entrega)
    {
        $items = $entrega->getProdutoEntregas();

        $user = $this->security->getUser();
        $postoAjuda = $user->getPostoAjuda();

        foreach($items as $produtoEntrega) {
            $produtoPosto = $this->produtoPostoRepository->findOneBy(["posto"=>$postoAjuda, "produto"=>$produtoEntrega->getProduto()]);
            $quantidadeTotal = $produtoPosto->getQuantidade();
            $quantidadeTotal = floatval($quantidadeTotal) - floatval($produtoEntrega->getQuantidade());
            if($quantidadeTotal < 0) {
                $quantidadeTotal = 0;
            }
            $produtoPosto->setQuantidade($quantidadeTotal);
            $this->entityManager->persist($produtoPosto);
        }
        
        $this->entityManager->flush();
    }

}
