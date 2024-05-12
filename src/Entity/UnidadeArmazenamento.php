<?php

namespace App\Entity;

use App\Repository\UnidadeArmazenamentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadeArmazenamentoRepository::class)]
class UnidadeArmazenamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $descricao = null;

    /**
     * @var Collection<int, Produto>
     */
    #[ORM\OneToMany(targetEntity: Produto::class, mappedBy: 'unidadeArmazenamento')]
    private Collection $produtos;

    /**
     * @var Collection<int, UnidadeConversao>
     */
    #[ORM\OneToMany(targetEntity: UnidadeConversao::class, mappedBy: 'unidadeArmazenamento')]
    private Collection $unidadesConversao;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
        $this->unidadesConversao = new ArrayCollection();
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
            $produto->setUnidadeArmazenamento($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): static
    {
        if ($this->produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getUnidadeArmazenamento() === $this) {
                $produto->setUnidadeArmazenamento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UnidadeConversao>
     */
    public function getUnidadesConversao(): Collection
    {
        return $this->unidadesConversao;
    }

    public function addUnidadesConversao(UnidadeConversao $unidadesConversao): static
    {
        if (!$this->unidadesConversao->contains($unidadesConversao)) {
            $this->unidadesConversao->add($unidadesConversao);
            $unidadesConversao->setUnidadeArmazenamento($this);
        }

        return $this;
    }

    public function removeUnidadesConversao(UnidadeConversao $unidadesConversao): static
    {
        if ($this->unidadesConversao->removeElement($unidadesConversao)) {
            // set the owning side to null (unless already changed)
            if ($unidadesConversao->getUnidadeArmazenamento() === $this) {
                $unidadesConversao->setUnidadeArmazenamento(null);
            }
        }

        return $this;
    }
}
