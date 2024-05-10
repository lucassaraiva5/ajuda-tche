<?php

namespace App\Entity;

use App\Repository\CentroDistribuicaoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CentroDistribuicaoRepository::class)]
class CentroDistribuicao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $descricao = null;

    #[ORM\ManyToOne]
    private ?Cidade $cidade = null;

    #[ORM\ManyToOne]
    private ?Estado $estado = null;

    #[ORM\ManyToOne]
    private ?Usuario $usuario = null;

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

    public function getCidade(): ?Cidade
    {
        return $this->cidade;
    }

    public function setCidade(?Cidade $cidade): static
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
