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
    private ?string $Descrição = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrição(): ?string
    {
        return $this->Descrição;
    }

    public function setDescrição(string $Descrição): static
    {
        $this->Descrição = $Descrição;

        return $this;
    }
}
