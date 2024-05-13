<?php

namespace App\Entity;

use App\Repository\FuncaoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FuncaoRepository::class)]
class Funcao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $descricao = null;

    #[ORM\ManyToOne(inversedBy: 'funcoes')]
    private ?PostoAjuda $postoAjuda = null;

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

    public function getPostoAjuda(): ?PostoAjuda
    {
        return $this->postoAjuda;
    }

    public function setPostoAjuda(?PostoAjuda $postoAjuda): static
    {
        $this->postoAjuda = $postoAjuda;

        return $this;
    }
}
