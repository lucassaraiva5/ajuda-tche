<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510023812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posto_coleta ADD estado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934A9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_2BDC934A9F5A440B ON posto_coleta (estado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934A9F5A440B');
        $this->addSql('DROP INDEX IDX_2BDC934A9F5A440B ON posto_coleta');
        $this->addSql('ALTER TABLE posto_coleta DROP estado_id');
    }
}
