<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\ProdutoEntregaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoEntregaRepository::class)]
class ProdutoEntrega implements AppEntityInterface

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Produto $produto = null;

    #[ORM\Column]
    private ?float $quantidade = null;

    #[ORM\ManyToOne(inversedBy: 'produtoEntrega')]
    private ?Entrega $entrega = null;

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

    public function getEntrega(): ?Entrega
    {
        return $this->entrega;
    }

    public function setEntrega(?Entrega $entrega): static
    {
        $this->entrega = $entrega;

        return $this;
    }

    public function getQuantidade(): ?float
    {
        return $this->quantidade;
    }

    public function setQuantidade(float $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }
}
