<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\PostoAjudaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostoAjudaRepository::class)]
class PostoAjuda implements AppEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300)]
    private ?string $descricao = null;

    #[ORM\ManyToOne]
    private ?Cidade $cidade = null;

    #[ORM\ManyToOne]
    private ?Estado $estado = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuarioResponsavel = null;

    /**
     * @var Collection<int, TipoPostoAjuda>
     */
    #[ORM\ManyToMany(targetEntity: TipoPostoAjuda::class)]
    private Collection $tipoPostoAjuda;

    /**
     * @var Collection<int, Usuario>
     */
    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'postoAjuda')]
    private Collection $usuarios;

    /**
     * @var Collection<int, Funcao>
     */
    #[ORM\OneToMany(targetEntity: Funcao::class, mappedBy: 'postoAjuda')]
    private Collection $funcoes;

    public function __construct()
    {
        $this->tipoPostoAjuda = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
        $this->funcoes = new ArrayCollection();
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

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsuarioResponsavel(): ?Usuario
    {
        return $this->usuarioResponsavel;
    }

    public function setUsuarioResponsavel(?Usuario $usuarioResponsavel): static
    {
        $this->usuarioResponsavel = $usuarioResponsavel;

        return $this;
    }

    /**
     * @return Collection<int, TipoPostoAjuda>
     */
    public function getTipoPostoAjuda(): Collection
    {
        return $this->tipoPostoAjuda;
    }

    public function addTipoPostoAjuda(TipoPostoAjuda $tipoPostoAjuda): static
    {
        if (!$this->tipoPostoAjuda->contains($tipoPostoAjuda)) {
            $this->tipoPostoAjuda->add($tipoPostoAjuda);
        }

        return $this;
    }

    public function removeTipoPostoAjuda(TipoPostoAjuda $tipoPostoAjuda): static
    {
        $this->tipoPostoAjuda->removeElement($tipoPostoAjuda);

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->setPostoAjuda($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getPostoAjuda() === $this) {
                $usuario->setPostoAjuda(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Funcao>
     */
    public function getFuncoes(): Collection
    {
        return $this->funcoes;
    }

    public function addFunco(Funcao $funco): static
    {
        if (!$this->funcoes->contains($funco)) {
            $this->funcoes->add($funco);
            $funco->setPostoAjuda($this);
        }

        return $this;
    }

    public function removeFunco(Funcao $funco): static
    {
        if ($this->funcoes->removeElement($funco)) {
            // set the owning side to null (unless already changed)
            if ($funco->getPostoAjuda() === $this) {
                $funco->setPostoAjuda(null);
            }
        }

        return $this;
    }
}
