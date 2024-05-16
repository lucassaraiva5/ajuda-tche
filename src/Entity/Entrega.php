<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\EntregaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Entrega implements AppEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Motorista $motorista = null;

    /**
     * @var Collection<int, ProdutoEntrega>
     */
    #[ORM\OneToMany(targetEntity: ProdutoEntrega::class, mappedBy: 'entrega', cascade:["persist", "remove"])]
    private Collection $produtoEntregas;

    #[ORM\ManyToOne(inversedBy: 'entregas')]
    private ?PostoAjuda $postoAjuda = null;

    #[ORM\ManyToOne]
    private ?PostoAjuda $postoAjudaDestino = null;

    #[ORM\Column(length: 300, nullable: false)]
    private ?string $observacaoDestino = null;

    public function __construct()
    {
        $this->produtoEntregas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotorista(): ?Motorista
    {
        return $this->motorista;
    }

    public function setMotorista(?Motorista $motorista): static
    {
        $this->motorista = $motorista;

        return $this;
    }

    /**
     * @return Collection<int, ProdutoEntrega>
     */
    public function getProdutoEntregas(): Collection
    {
        return $this->produtoEntregas;
    }

    public function addProdutoEntrega(ProdutoEntrega $produtoEntrega): static
    {
        if (!$this->produtoEntregas->contains($produtoEntrega)) {
            $this->produtoEntregas->add($produtoEntrega);
            $produtoEntrega->setEntrega($this);
        }

        return $this;
    }

    public function removeProdutoEntrega(ProdutoEntrega $produtoEntrega): static
    {
        if ($this->produtoEntregas->removeElement($produtoEntrega)) {
            // set the owning side to null (unless already changed)
            if ($produtoEntrega->getEntrega() === $this) {
                $produtoEntrega->setEntrega(null);
            }
        }

        return $this;
    }

    public function cleanProdutoEntrega()
    {
        $this->produtoEntregas = new ArrayCollection();
    }

    public function checkIfProdutoAlreadyAdded(Produto $produto): ?ProdutoEntrega
    {
        foreach ($this->produtoEntregas as $produtoEntrega) {
            if($produtoEntrega->getProduto() === $produto) {
                return $produtoEntrega;
            }
        }

        return null;
    }

    public function getPostoAjuda(): ?PostoAjuda
    {
        return $this->postoAjuda;
    }

    public function setPostoAjuda(?PostoAjuda $postoAjuda): static
    {
        $this->postoAjuda = $postoAjuda;

        return $this;
    }

    public function getPostoAjudaDestino(): ?PostoAjuda
    {
        return $this->postoAjudaDestino;
    }

    public function setPostoAjudaDestino(?PostoAjuda $postoAjudaDestino): static
    {
        $this->postoAjudaDestino = $postoAjudaDestino;

        return $this;
    }

    public function getObservacaoDestino(): ?string
    {
        return $this->observacaoDestino;
    }

    public function setObservacaoDestino(?string $observacaoDestino): static
    {
        $this->observacaoDestino = $observacaoDestino;

        return $this;
    }
}
