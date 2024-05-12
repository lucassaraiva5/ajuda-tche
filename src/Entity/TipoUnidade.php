<?php

namespace App\Entity;

use App\Repository\TipoUnidadeRepository;
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
}
