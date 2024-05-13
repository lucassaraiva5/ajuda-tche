<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\PostoColetaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostoColetaRepository::class)]
class PostoColeta implements AppEntityInterface
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
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    private ?Estado $estado = null;

    /**
     * @var Collection<int, Voluntario>
     */
    #[ORM\OneToMany(targetEntity: Voluntario::class, mappedBy: 'postoColeta')]
    private Collection $voluntarios;

    public function __construct()
    {
        $this->voluntarios = new ArrayCollection();
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

    public function getCidade(): ?Cidade
    {
        return $this->cidade;
    }

    public function setCidade(?Cidade $cidade): static
    {
        $this->cidade = $cidade;

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

    public function getEstado(): ?estado
    {
        return $this->estado;
    }

    public function setEstado(?estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection<int, Voluntario>
     */
    public function getVoluntarios(): Collection
    {
        return $this->voluntarios;
    }

    public function addVoluntario(Voluntario $voluntario): static
    {
        if (!$this->voluntarios->contains($voluntario)) {
            $this->voluntarios->add($voluntario);
            $voluntario->setPostoColeta($this);
        }

        return $this;
    }

    public function removeVoluntario(Voluntario $voluntario): static
    {
        if ($this->voluntarios->removeElement($voluntario)) {
            // set the owning side to null (unless already changed)
            if ($voluntario->getPostoColeta() === $this) {
                $voluntario->setPostoColeta(null);
            }
        }

        return $this;
    }
}
