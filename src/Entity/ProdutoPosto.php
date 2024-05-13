<?php

namespace App\Entity;

use App\Repository\ProdutoPostoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoPostoRepository::class)]
class ProdutoPosto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Produto $produto = null;

    #[ORM\ManyToOne]
    private ?PostoAjuda $posto = null;

    #[ORM\Column]
    private ?float $quantidade = null;

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

    public function getPosto(): ?PostoAjuda
    {
        return $this->posto;
    }

    public function setPosto(?PostoAjuda $posto): static
    {
        $this->posto = $posto;

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
