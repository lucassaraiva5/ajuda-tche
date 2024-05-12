<?php

namespace App\Entity;

use App\Repository\TipoUnidadeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoUnidadeRepository::class)]
class TipoUnidade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $descricao = null;

    /**
     * @var Collection<int, Produto>
     */
    #[ORM\ManyToMany(targetEntity: Produto::class, mappedBy: 'tiposUnidade')]
    private Collection $produtos;

    #[ORM\Column]
    private ?int $valor = null;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection<int, Produto>
     */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }

    public function addProduto(Produto $produto): static
    {
        if (!$this->produtos->contains($produto)) {
            $this->produtos->add($produto);
            $produto->addTiposUnidade($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): static
    {
        if ($this->produtos->removeElement($produto)) {
            $produto->removeTiposUnidade($this);
        }

        return $this;
    }

    public function getValor(): ?int
    {
        return $this->valor;
    }

    public function setValor(int $valor): static
    {
        $this->valor = $valor;

        return $this;
    }
}
