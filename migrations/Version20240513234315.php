<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513234315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO cor_da_pele (descricao) VALUES
            ('Amarela'),
            ('Branca'),
            ('Indígena'),
            ('Parda'),
            ('Preta')");

        $this->addSql("INSERT INTO genero (descricao) VALUES
            ('Feminino'),
            ('Masculino'),
            ('Não desejo informar')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
