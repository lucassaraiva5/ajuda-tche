<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513032747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO produto (descricao, categoria_id) VALUES
                ('Pasta de dente', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Escova de dente', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Sabonete', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Shampoo', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Condicionador', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Enxaguante Bucal', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Fio Dental', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Laminas de barbear', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Lenços Umedecidos', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Fraldas', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Absorvente', (select id from categoria where descricao = 'Higiene Pessoal')),
                ('Toalha de banho', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Cobertor', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Colchão de Berço', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Colchão de solteiro', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Colchão de Casal', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Lençol', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Travesseiro', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Pano de prato', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Copo', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Garfo', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Faca', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Colher', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Prato', (select id from categoria where descricao = 'Cama/Mesa/Banho')),
                ('Composto para Bebe (Até 6 meses)', (select id from categoria where descricao = 'Bebidas')),
                ('Composto para Bebe (6 meses - 1 Ano)', (select id from categoria where descricao = 'Bebidas')),
                ('Fórmula infantil 1 ano+', (select id from categoria where descricao = 'Bebidas')),
                ('Leite', (select id from categoria where descricao = 'Bebidas')),
                ('Leite sem lactose', (select id from categoria where descricao = 'Bebidas')),
                ('Agua', (select id from categoria where descricao = 'Bebidas')),
                ('Água com gás', (select id from categoria where descricao = 'Bebidas')),
                ('Refrigerante', (select id from categoria where descricao = 'Bebidas')),
                ('Suco', (select id from categoria where descricao = 'Bebidas')),
                ('Isotonico', (select id from categoria where descricao = 'Bebidas')),
                ('Cesta básica', (select id from categoria where descricao = 'Alimentos')),
                ('Farinha de Trigo', (select id from categoria where descricao = 'Alimentos')),
                ('Macarrão/massa', (select id from categoria where descricao = 'Alimentos')),
                ('Arroz', (select id from categoria where descricao = 'Alimentos')),
                ('Feijão', (select id from categoria where descricao = 'Alimentos')),
                ('Café', (select id from categoria where descricao = 'Alimentos')),
                ('Bolacha/biscoito', (select id from categoria where descricao = 'Alimentos')),
                ('Achocolatado em pó', (select id from categoria where descricao = 'Alimentos')),
                ('Milho', (select id from categoria where descricao = 'Alimentos')),
                ('Ervilha', (select id from categoria where descricao = 'Alimentos')),
                ('Seleta de legumes', (select id from categoria where descricao = 'Alimentos')),
                ('Pessego enlatado', (select id from categoria where descricao = 'Alimentos')),
                ('Abacaxi enlatado', (select id from categoria where descricao = 'Alimentos')),
                ('Sardinha', (select id from categoria where descricao = 'Alimentos')),
                ('Feijão enlatado', (select id from categoria where descricao = 'Alimentos')),
                ('Atum', (select id from categoria where descricao = 'Alimentos')),
                ('Bacon', (select id from categoria where descricao = 'Alimentos')),
                ('Salame', (select id from categoria where descricao = 'Alimentos')),
                ('Agua Sanitária', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Alcool', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Desinfetante', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Detergente', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Rodo', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Vassoura', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Aromatizador', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Esfregão/mop', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Sabão em pó', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Amaciante', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Sabão em barra', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Desengordurante', (select id from categoria where descricao = 'Produtos de Limpeza')),
                ('Paracetamol (Tylenol, Vicky Pyrena, Dorfen)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Dipirona (Dorflex, Neusaodina, Benegripe)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Ibuprofeno (Advil, Alivium, Buscofem, Artril)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Ácido Acetilsalicílico (AAS, Aspirina, Bufferin, Melhoral, AS-Med)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Insulina', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Termometro', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Esfigmomanômetro (Aparelho de medir pressão)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Medidor de glicose', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Oximetro', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Nebulizador', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Agua oxigenada', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Gaze', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Algodão', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Esparadrapo', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Soro Fisiológico', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Bandagem Adesiva', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Desfibrilador', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Estetoscopio', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Chá', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Codeina (Tylex)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Rispiridona', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Clonazepam (Rivotril)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Losartana potássica', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Fenobarbital (GARDENAL)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Nimesulida (Cimelid, Nimesilam, Nimelit, Nisoflan, Cataflan, Deltaflan)', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Amoxicilina + Clavulanato de potássio', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Antiseptico Nasal', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Anticoncepcional', (select id from categoria where descricao = 'Medicamentos/Saude')),
                ('Brinquedos', (select id from categoria where descricao = 'Itens em geral'))");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
