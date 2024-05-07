<?php

namespace App\Entity;

use App\Repository\EntregaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Entrega
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
    #[ORM\OneToMany(targetEntity: ProdutoEntrega::class, mappedBy: 'entrega')]
    private Collection $produtoEntrega;

    public function __construct()
    {
        $this->produtoEntrega = new ArrayCollection();
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
    public function getProdutoEntrega(): Collection
    {
        return $this->produtoEntrega;
    }

    public function addProdutoEntrega(ProdutoEntrega $produtoEntrega): static
    {
        if (!$this->produtoEntrega->contains($produtoEntrega)) {
            $this->produtoEntrega->add($produtoEntrega);
            $produtoEntrega->setEntrega($this);
        }

        return $this;
    }

    public function removeProdutoEntrega(ProdutoEntrega $produtoEntrega): static
    {
        if ($this->produtoEntrega->removeElement($produtoEntrega)) {
            // set the owning side to null (unless already changed)
            if ($produtoEntrega->getEntrega() === $this) {
                $produtoEntrega->setEntrega(null);
            }
        }

        return $this;
    }
}
