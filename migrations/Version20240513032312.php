<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513032312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO categoria (descricao) VALUES
            ('Higiene Pessoal'),
            ('Cama/Mesa/Banho'),
            ('Bebidas'),
            ('Alimentos'),
            ('Produtos de Limpeza'),
            ('Medicamentos/Saude'),
            ('Itens em geral'),
            ('Materiais de construção')");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
