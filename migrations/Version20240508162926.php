<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508162926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE centro_distribuicao ADD estado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788F9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_EBE1788F9F5A440B ON centro_distribuicao (estado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788F9F5A440B');
        $this->addSql('DROP INDEX IDX_EBE1788F9F5A440B ON centro_distribuicao');
        $this->addSql('ALTER TABLE centro_distribuicao DROP estado_id');
    }
}
