<?php

namespace App\Entity;

use App\Repository\PostoColetaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostoColetaRepository::class)]
class PostoColeta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $descricao = null;

    #[ORM\ManyToOne]
    private ?Cidade $cidade = null;

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
}
