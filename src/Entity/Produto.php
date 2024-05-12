<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $descricao = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    private ?Categoria $categoria = null;

    #[ORM\ManyToOne(inversedBy: 'produtos')]
    private ?UnidadeArmazenamento $unidadeArmazenamento = null;

    /**
     * @var Collection<int, TipoUnidade>
     */
    #[ORM\ManyToMany(targetEntity: TipoUnidade::class, inversedBy: 'produtos')]
    private Collection $tiposUnidade;

    /**
     * @var Collection<int, UnidadeConversao>
     */
    #[ORM\ManyToMany(targetEntity: UnidadeConversao::class, inversedBy: 'produtos')]
    private Collection $unidadesConversao;

    public function __construct()
    {
        $this->tiposUnidade = new ArrayCollection();
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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getUnidadeArmazenamento(): ?UnidadeArmazenamento
    {
        return $this->unidadeArmazenamento;
    }

    public function setUnidadeArmazenamento(?UnidadeArmazenamento $unidadeArmazenamento): static
    {
        $this->unidadeArmazenamento = $unidadeArmazenamento;

        return $this;
    }

    /**
     * @return Collection<int, TipoUnidade>
     */
    public function getTiposUnidade(): Collection
    {
        return $this->tiposUnidade;
    }

    public function addTiposUnidade(TipoUnidade $tiposUnidade): static
    {
        if (!$this->tiposUnidade->contains($tiposUnidade)) {
            $this->tiposUnidade->add($tiposUnidade);
        }

        return $this;
    }

    public function removeTiposUnidade(TipoUnidade $tiposUnidade): static
    {
        $this->tiposUnidade->removeElement($tiposUnidade);

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
        }

        return $this;
    }

    public function removeUnidadesConversao(UnidadeConversao $unidadesConversao): static
    {
        $this->unidadesConversao->removeElement($unidadesConversao);

        return $this;
    }
}
