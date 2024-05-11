<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511191222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE funcao (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voluntario (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, posto_coleta_id INT DEFAULT NULL, eh_aluno TINYINT(1) NOT NULL, telefone VARCHAR(15) DEFAULT NULL, INDEX IDX_216231FEDB38439E (usuario_id), INDEX IDX_216231FECE458A2B (posto_coleta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voluntario_funcao (voluntario_id INT NOT NULL, funcao_id INT NOT NULL, INDEX IDX_97F66F44BCFA9C0D (voluntario_id), INDEX IDX_97F66F44263E9CB2 (funcao_id), PRIMARY KEY(voluntario_id, funcao_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FECE458A2B FOREIGN KEY (posto_coleta_id) REFERENCES posto_coleta (id)');
        $this->addSql('ALTER TABLE voluntario_funcao ADD CONSTRAINT FK_97F66F44BCFA9C0D FOREIGN KEY (voluntario_id) REFERENCES voluntario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voluntario_funcao ADD CONSTRAINT FK_97F66F44263E9CB2 FOREIGN KEY (funcao_id) REFERENCES funcao (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FEDB38439E');
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FECE458A2B');
        $this->addSql('ALTER TABLE voluntario_funcao DROP FOREIGN KEY FK_97F66F44BCFA9C0D');
        $this->addSql('ALTER TABLE voluntario_funcao DROP FOREIGN KEY FK_97F66F44263E9CB2');
        $this->addSql('DROP TABLE funcao');
        $this->addSql('DROP TABLE voluntario');
        $this->addSql('DROP TABLE voluntario_funcao');
    }
}
