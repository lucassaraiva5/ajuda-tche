<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513032203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO tipo_unidade (descricao, valor) VALUES
            ('Unidade', 1),
            ('Kit/Caixa/fardo com 5', 5),
            ('Kit/Caixa/fardo com 6', 6),
            ('Kit/Caixa/fardo com 8', 8),
            ('Kit/Caixa/fardo com 10', 10),
            ('Duzia / Kit/Caixa/fardo com 12', 12),
            ('Kit com 20', 20),
            ('Par', 1),
            ('Metro', 1),
            ('Litro', 1)");

        $this->addSql("INSERT INTO unidade_armazenamento (descricao) VALUES
            ('Litro'),
            ('Quilogramas'),
            ('Unidades'),
            ('Peças'),
            ('Metro')");

        $this->addSql("INSERT INTO unidade_conversao (descricao, valor, unidade_armazenamento_id) VALUES
            ('500ml', 0.5, (select id unidade_armazenamento where descricao = 'Litro')),
            ('1L', 1, (select id unidade_armazenamento where descricao = 'Litro')),
            ('1,5L', 1.5, (select id unidade_armazenamento where descricao = 'Litro')),
            ('2L', 2, (select id unidade_armazenamento where descricao = 'Litro')),
            ('5L', 5, (select id unidade_armazenamento where descricao = 'Litro')),
            ('10L', 10, (select id unidade_armazenamento where descricao = 'Litro')),
            ('20L', 20, (select id unidade_armazenamento where descricao = 'Litro')),
            ('395g', 0.395, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('400g', 0.4, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('500g', 0.5, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('1kg', 1, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('2kg', 2, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('5kg', 5, (select id unidade_armazenamento where descricao = 'Quilogramas')),
            ('10kg', 10, (select id unidade_armazenamento where descricao = 'Quilogramas'))");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
