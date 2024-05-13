<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513204543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("update unidade_conversao set unidade_armazenamento_id = (select id from unidade_armazenamento where descricao = 'Litro') where descricao in ('500ml','1L','1,5L','2L','5L','10L','20L')");
        $this->addSql("update unidade_conversao set unidade_armazenamento_id = (select id from unidade_armazenamento where descricao = 'Quilogramas') where descricao in ('395g','400g','500g','1kg','2kg','5kg','10kg')");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
