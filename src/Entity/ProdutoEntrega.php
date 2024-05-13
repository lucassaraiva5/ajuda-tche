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
    private ?ProdutoNecessario $ProdutoNecessario = null;

    #[ORM\ManyToOne(inversedBy: 'produtoEntrega')]
    private ?Entrega $entrega = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdutoNecessario(): ?ProdutoNecessario
    {
        return $this->ProdutoNecessario;
    }

    public function setProdutoNecessario(?ProdutoNecessario $ProdutoNecessario): static
    {
        $this->ProdutoNecessario = $ProdutoNecessario;

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
}
