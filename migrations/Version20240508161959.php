<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508161959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cidade (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_6A98335C9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, uf VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cidade ADD CONSTRAINT FK_6A98335C9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE centro_distribuicao ADD cidade_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788F9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('CREATE INDEX IDX_EBE1788F9586CC8 ON centro_distribuicao (cidade_id)');
        $this->addSql('ALTER TABLE posto_coleta ADD cidade_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934A9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('CREATE INDEX IDX_2BDC934A9586CC8 ON posto_coleta (cidade_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788F9586CC8');
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934A9586CC8');
        $this->addSql('ALTER TABLE cidade DROP FOREIGN KEY FK_6A98335C9F5A440B');
        $this->addSql('DROP TABLE cidade');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP INDEX IDX_2BDC934A9586CC8 ON posto_coleta');
        $this->addSql('ALTER TABLE posto_coleta DROP cidade_id');
        $this->addSql('DROP INDEX IDX_EBE1788F9586CC8 ON centro_distribuicao');
        $this->addSql('ALTER TABLE centro_distribuicao DROP cidade_id');
    }
}
