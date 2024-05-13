<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513124317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $arrayProdutosUnidadeArmazenamento = [
            'Pasta de dente' => 'Unidades',
            'Escova de dente' => 'Unidades',
            'Sabonete' => 'Unidades',
            'Shampoo' => 'Unidades',
            'Condicionador' => 'Unidades',
            'Enxaguante Bucal' => 'Unidades',
            'Fio Dental' => 'Unidades',
            'Laminas de barbear' => 'Unidades',
            'Lenços Umedecidos' => 'Unidades',
            'Fraldas' => 'Unidades',
            'Absorvente' => 'Unidades',
            'Toalha de banho' => 'Unidades',
            'Cobertor' => 'Unidades',
            'Colchão de Berço' => 'Unidades',
            'Colchão de solteiro' => 'Unidades',
            'Colchão de Casal' => 'Unidades',
            'Lençol' => 'Unidades',
            'Travesseiro' => 'Unidades',
            'Pano de prato' => 'Unidades',
            'Copo' => 'Unidades',
            'Garfo' => 'Unidades',
            'Faca' => 'Unidades',
            'Colher' => 'Unidades',
            'Prato' => 'Unidades',
            'Composto para Bebe (Até 6 meses)' => 'Quilogramas',
            'Composto para Bebe (6 meses - 1 Ano)' => 'Quilogramas',
            'Fórmula infantil 1 ano+' => 'Quilogramas',
            'Leite' => 'Litro',
            'Leite sem lactose' => 'Litro',
            'Agua' => 'Litro',
            'Água com gás' => 'Litro',
            'Refrigerante' => 'Litro',
            'Suco' => 'Litro',
            'Isotonico' => 'Litro',
            'Cesta básica' => 'Unidades',
            'Farinha de Trigo' => 'Quilogramas',
            'Macarrão/massa' => 'Quilogramas',
            'Arroz' => 'Quilogramas',
            'Feijão' => 'Quilogramas',
            'Café' => 'Quilogramas',
            'Bolacha/biscoito' => 'Quilogramas',
            'Achocolatado em pó' => 'Quilogramas',
            'Milho' => 'Quilogramas',
            'Ervilha' => 'Quilogramas',
            'Seleta de legumes' => 'Quilogramas',
            'Pessego enlatado' => 'Quilogramas',
            'Abacaxi enlatado' => 'Quilogramas',
            'Sardinha' => 'Quilogramas',
            'Feijão enlatado' => 'Quilogramas',
            'Atum' => 'Quilogramas',
            'Bacon' => 'Quilogramas',
            'Salame' => 'Quilogramas',
            'Agua Sanitária' => 'Quilogramas',
            'Alcool' => 'Litro',
            'Desinfetante' => 'Litro',
            'Detergente' => 'Litro',
            'Rodo' => 'Unidades',
            'Vassoura' => 'Unidades',
            'Aromatizador' => 'Unidades',
            'Esfregão/mop' => 'Unidades',
            'Sabão em pó' => 'Unidades',
            'Amaciante' => 'Litro',
            'Sabão em barra' => 'Unidades',
            'Desengordurante' => 'Unidades',
            'Paracetamol (Tylenol, Vicky Pyrena, Dorfen)' => 'Unidades',
            'Dipirona (Dorflex, Neusaodina, Benegripe)' => 'Unidades',
            'Ibuprofeno (Advil, Alivium, Buscofem, Artril)' => 'Unidades',
            'Ácido Acetilsalicílico (AAS, Aspirina, Bufferin, Melhoral, AS-Med)' => 'Unidades',
            'Insulina' => 'Unidades',
            'Termometro' => 'Unidades',
            'Esfigmomanômetro (Aparelho de medir pressão)' => 'Unidades',
            'Medidor de glicose' => 'Unidades',
            'Oximetro' => 'Unidades',
            'Nebulizador' => 'Unidades',
            'Agua oxigenada' => 'Unidades',
            'Gaze' => 'Unidades',
            'Algodão' => 'Unidades',
            'Esparadrapo' => 'Unidades',
            'Soro Fisiológico' => 'Unidades',
            'Bandagem Adesiva' => 'Unidades',
            'Desfibrilador' => 'Unidades',
            'Estetoscopio' => 'Unidades',
            'Chá' => 'Unidades',
            'Codeina (Tylex)' => 'Unidades',
            'Rispiridona' => 'Unidades',
            'Clonazepam (Rivotril)' => 'Unidades',
            'Losartana potássica' => 'Unidades',
            'Fenobarbital (GARDENAL)' => 'Unidades',
            'Nimesulida (Cimelid, Nimesilam, Nimelit, Nisoflan, Cataflan, Deltaflan)' => 'Unidades',
            'Amoxicilina + Clavulanato de potássio' => 'Unidades',
            'Antiseptico Nasal' => 'Unidades',
            'Anticoncepcional' => 'Unidades',
            'Brinquedos' => 'Unidades',
        ];

        foreach ($arrayProdutosUnidadeArmazenamento as $produto => $unidadeArmazenamento) {
            $this->addSql("update produto set unidade_armazenamento_id = (select id from unidade_armazenamento where descricao = '{$unidadeArmazenamento}') where descricao = '{$produto}'");
        }

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
