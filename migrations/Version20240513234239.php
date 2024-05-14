<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513234239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cor_da_pele (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE desalojado (id INT AUTO_INCREMENT NOT NULL, genero_id INT NOT NULL, cor_da_pele_id INT DEFAULT NULL, cidade_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, nome VARCHAR(50) NOT NULL, sobrenome VARCHAR(100) DEFAULT NULL, nome_pai VARCHAR(150) DEFAULT NULL, nome_mae VARCHAR(150) DEFAULT NULL, celular VARCHAR(15) DEFAULT NULL, proprietario_celular VARCHAR(50) DEFAULT NULL, logradouro VARCHAR(120) DEFAULT NULL, numero VARCHAR(50) DEFAULT NULL, bairro VARCHAR(100) DEFAULT NULL, INDEX IDX_872A9212BCE7B795 (genero_id), INDEX IDX_872A921249CAF5CD (cor_da_pele_id), INDEX IDX_872A92129586CC8 (cidade_id), INDEX IDX_872A92129F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE desalojado ADD CONSTRAINT FK_872A9212BCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE desalojado ADD CONSTRAINT FK_872A921249CAF5CD FOREIGN KEY (cor_da_pele_id) REFERENCES cor_da_pele (id)');
        $this->addSql('ALTER TABLE desalojado ADD CONSTRAINT FK_872A92129586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE desalojado ADD CONSTRAINT FK_872A92129F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE desalojado DROP FOREIGN KEY FK_872A9212BCE7B795');
        $this->addSql('ALTER TABLE desalojado DROP FOREIGN KEY FK_872A921249CAF5CD');
        $this->addSql('ALTER TABLE desalojado DROP FOREIGN KEY FK_872A92129586CC8');
        $this->addSql('ALTER TABLE desalojado DROP FOREIGN KEY FK_872A92129F5A440B');
        $this->addSql('DROP TABLE cor_da_pele');
        $this->addSql('DROP TABLE desalojado');
        $this->addSql('DROP TABLE genero');
    }
}
