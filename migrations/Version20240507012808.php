<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507012808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centro_distribuicao (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrega (id INT AUTO_INCREMENT NOT NULL, motorista_id INT DEFAULT NULL, INDEX IDX_E56D596B1959881F (motorista_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motorista (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posto_coleta (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT DEFAULT NULL, descricao VARCHAR(200) NOT NULL, INDEX IDX_5CAC49D73397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_entrega (id INT AUTO_INCREMENT NOT NULL, produto_necessario_id INT DEFAULT NULL, entrega_id INT DEFAULT NULL, INDEX IDX_DF5304E6703B62 (produto_necessario_id), INDEX IDX_DF5304E67AB91AEC (entrega_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_necessario (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, centro_distribuicao_id INT DEFAULT NULL, quantidade INT NOT NULL, INDEX IDX_143A8F10105CFD56 (produto_id), INDEX IDX_143A8F10BCC3B876 (centro_distribuicao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_posto (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, posto_id INT DEFAULT NULL, quantidade INT NOT NULL, INDEX IDX_2EA76DEF105CFD56 (produto_id), INDEX IDX_2EA76DEFCF2DB0E2 (posto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrega ADD CONSTRAINT FK_E56D596B1959881F FOREIGN KEY (motorista_id) REFERENCES motorista (id)');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E6703B62 FOREIGN KEY (produto_necessario_id) REFERENCES produto_necessario (id)');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E67AB91AEC FOREIGN KEY (entrega_id) REFERENCES entrega (id)');
        $this->addSql('ALTER TABLE produto_necessario ADD CONSTRAINT FK_143A8F10105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produto_necessario ADD CONSTRAINT FK_143A8F10BCC3B876 FOREIGN KEY (centro_distribuicao_id) REFERENCES centro_distribuicao (id)');
        $this->addSql('ALTER TABLE produto_posto ADD CONSTRAINT FK_2EA76DEF105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produto_posto ADD CONSTRAINT FK_2EA76DEFCF2DB0E2 FOREIGN KEY (posto_id) REFERENCES posto_coleta (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrega DROP FOREIGN KEY FK_E56D596B1959881F');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73397707A');
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E6703B62');
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E67AB91AEC');
        $this->addSql('ALTER TABLE produto_necessario DROP FOREIGN KEY FK_143A8F10105CFD56');
        $this->addSql('ALTER TABLE produto_necessario DROP FOREIGN KEY FK_143A8F10BCC3B876');
        $this->addSql('ALTER TABLE produto_posto DROP FOREIGN KEY FK_2EA76DEF105CFD56');
        $this->addSql('ALTER TABLE produto_posto DROP FOREIGN KEY FK_2EA76DEFCF2DB0E2');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE centro_distribuicao');
        $this->addSql('DROP TABLE entrega');
        $this->addSql('DROP TABLE motorista');
        $this->addSql('DROP TABLE posto_coleta');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE produto_entrega');
        $this->addSql('DROP TABLE produto_necessario');
        $this->addSql('DROP TABLE produto_posto');
    }
}
