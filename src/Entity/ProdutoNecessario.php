<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\ProdutoNecessarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoNecessarioRepository::class)]
class ProdutoNecessario implements AppEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Produto $produto = null;

    #[ORM\ManyToOne]
    private ?CentroDistribuicao $centroDistribuicao = null;

    #[ORM\Column]
    private ?int $quantidade = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduto(): ?Produto
    {
        return $this->produto;
    }

    public function setProduto(?Produto $produto): static
    {
        $this->produto = $produto;

        return $this;
    }

    public function getCentroDistribuicao(): ?CentroDistribuicao
    {
        return $this->centroDistribuicao;
    }

    public function setCentroDistribuicao(?CentroDistribuicao $centroDistribuicao): static
    {
        $this->centroDistribuicao = $centroDistribuicao;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }
}
