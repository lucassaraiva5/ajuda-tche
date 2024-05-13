<?php

namespace App\Service;

use App\Entity\PostoAjuda;
use App\Entity\ProdutoPosto;
use App\Entity\UnidadeConversao;
use App\Entity\Usuario;
use App\Repository\PostoAjudaRepository;
use App\Repository\ProdutoPostoRepository;
use App\Repository\ProdutoRepository;
use App\Repository\TipoUnidadeRepository;
use App\Repository\UnidadeConversaoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

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
        $postoAjuda = $this->postoAjudaRepository->findOneByUsuarioResponsavel($user);

        $tipoUnidade = $this->tipoUnidadeRepository->find($data["produto_posto"]["tipoUnidade"]);

        $unidadeMultiplicador = 1;
        if(isset($data["produto_posto"]["unidadeConversao"])) {
            $unidadeConversao = $this->unidadeConversaoRepository->find($data["produto_posto"]["unidadeConversao"]);
            $unidadeMultiplicador = $unidadeConversao->getValor();
        }

        $produtoPostoExistente = $this->produtoPostoRepository->findOneByProduto($produtoPosto->getProduto());

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

    // public function conversaoParaUnidadeArmazenamento(ProdutoPosto $produtoPosto, ?ProdutoPosto $produtoPostoExistente = null): ProdutoPosto
    // {
    //     $unidadeConversao = $produtoPosto->getProduto()->getUnidadeArmazenamento();

    //     $produtoPosto->getQuantidade();


    //     return $produtoPosto;
    // }

}
