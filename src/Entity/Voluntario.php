<?php

namespace App\Entity;

use App\Entity\Interfaces\AppEntityInterface;
use App\Repository\VoluntarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoluntarioRepository::class)]
class Voluntario implements AppEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $ehAluno = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $telefone = null;

    #[ORM\ManyToOne]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'voluntarios')]
    private ?PostoAjuda $postoAjuda = null;

    /**
     * @var Collection<int, Funcao>
     */
    #[ORM\ManyToMany(targetEntity: Funcao::class)]
    private Collection $funcoes;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $sobrenome = null;

    #[ORM\Column(length: 2)]
    private ?string $codigoArea = null;

    #[ORM\ManyToOne(targetEntity: PostoColeta::class, inversedBy: 'voluntarios')]
    private ?PostoColeta $postoColeta = null;

    public function __construct()
    {
        $this->funcoes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEhAluno(): ?bool
    {
        return $this->ehAluno;
    }

    public function setEhAluno(bool $ehAluno): static
    {
        $this->ehAluno = $ehAluno;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): static
    {
        $this->telefone = $telefone;

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

    public function getPostoAjuda(): ?PostoAjuda
    {
        return $this->postoAjuda;
    }

    public function setPostoAjuda(?PostoAjuda $postoAjuda): static
    {
        $this->postoAjuda = $postoAjuda;

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
        }

        return $this;
    }

    public function removeFunco(Funcao $funco): static
    {
        $this->funcoes->removeElement($funco);

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSobrenome(): ?string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(?string $sobrenome): static
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    public function getCodigoArea(): ?string
    {
        return $this->codigoArea;
    }

    public function setCodigoArea(string $codigoArea): static
    {
        $this->codigoArea = $codigoArea;

        return $this;
    }

    public function getPostoColeta(): ?PostoColeta
    {
        return $this->postoColeta;
    }

    public function setPostoColeta(?PostoColeta $postoColeta): static
    {
        $this->postoColeta = $postoColeta;

        return $this;
    }
}
