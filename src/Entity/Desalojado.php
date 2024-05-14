<?php

namespace App\Entity;

use App\Repository\DesalojadoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesalojadoRepository::class)]
class Desalojado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nome = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $sobrenome = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nomePai = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nomeMae = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genero $genero = null;

    #[ORM\ManyToOne]
    private ?CorDaPele $corDaPele = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $celular = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $proprietarioCelular = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $logradouro = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $bairro = null;

    #[ORM\ManyToOne]
    private ?Cidade $cidade = null;

    #[ORM\ManyToOne]
    private ?Estado $estado = null;

    #[ORM\ManyToOne]
    private ?DesalojadoTipoAbrigo $desalojadoTipoAbrigo = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $cpf = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $cpfClean = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomePai(): ?string
    {
        return $this->nomePai;
    }

    public function setNomePai(?string $nomePai): static
    {
        $this->nomePai = $nomePai;

        return $this;
    }

    public function getNomeMae(): ?string
    {
        return $this->nomeMae;
    }

    public function setNomeMae(?string $nomeMae): static
    {
        $this->nomeMae = $nomeMae;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getCorDaPele(): ?CorDaPele
    {
        return $this->corDaPele;
    }

    public function setCorDaPele(?CorDaPele $corDaPele): static
    {
        $this->corDaPele = $corDaPele;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): static
    {
        $this->celular = $celular;

        return $this;
    }

    public function getProprietarioCelular(): ?string
    {
        return $this->proprietarioCelular;
    }

    public function setProprietarioCelular(?string $proprietarioCelular): static
    {
        $this->proprietarioCelular = $proprietarioCelular;

        return $this;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function setLogradouro(?string $logradouro): static
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): static
    {
        $this->bairro = $bairro;

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

    public function getDesalojadoTipoAbrigo(): ?DesalojadoTipoAbrigo
    {
        return $this->desalojadoTipoAbrigo;
    }

    public function setDesalojadoTipoAbrigo(?DesalojadoTipoAbrigo $desalojadoTipoAbrigo): static
    {
        $this->desalojadoTipoAbrigo = $desalojadoTipoAbrigo;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getCpfClean(): ?string
    {
        return $this->cpfClean;
    }

    public function setCpfClean(?string $cpfClean): static
    {
        $this->cpfClean = $cpfClean;

        return $this;
    }
}
