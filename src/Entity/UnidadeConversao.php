<?php

namespace App\Entity;

use App\Repository\UnidadeConversaoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnidadeConversaoRepository::class)]
class UnidadeConversao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $descricao = null;

    /**
     * @var Collection<int, Produto>
     */
    #[ORM\OneToMany(targetEntity: Produto::class, mappedBy: 'unidadeConversao')]
    private Collection $produtos;

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
            $produto->setUnidadeConversao($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): static
    {
        if ($this->produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getUnidadeConversao() === $this) {
                $produto->setUnidadeConversao(null);
            }
        }

        return $this;
    }
}
