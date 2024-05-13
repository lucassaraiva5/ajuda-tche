<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513032044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centro_distribuicao (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, descricao VARCHAR(200) NOT NULL, INDEX IDX_EBE1788F9586CC8 (cidade_id), INDEX IDX_EBE1788F9F5A440B (estado_id), INDEX IDX_EBE1788FDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cidade (id INT AUTO_INCREMENT NOT NULL, estado_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_6A98335C9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrega (id INT AUTO_INCREMENT NOT NULL, motorista_id INT DEFAULT NULL, INDEX IDX_E56D596B1959881F (motorista_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, uf VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcao (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motorista (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(200) NOT NULL, telefone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posto_ajuda (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, usuario_responsavel_id INT NOT NULL, descricao VARCHAR(300) NOT NULL, INDEX IDX_4D8C46FA9586CC8 (cidade_id), INDEX IDX_4D8C46FA9F5A440B (estado_id), INDEX IDX_4D8C46FADA07BCC9 (usuario_responsavel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posto_ajuda_tipo_posto_ajuda (posto_ajuda_id INT NOT NULL, tipo_posto_ajuda_id INT NOT NULL, INDEX IDX_BDA3869F9C3F14F3 (posto_ajuda_id), INDEX IDX_BDA3869F10ECDB53 (tipo_posto_ajuda_id), PRIMARY KEY(posto_ajuda_id, tipo_posto_ajuda_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posto_coleta (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, descricao VARCHAR(200) NOT NULL, INDEX IDX_2BDC934A9586CC8 (cidade_id), INDEX IDX_2BDC934ADB38439E (usuario_id), INDEX IDX_2BDC934A9F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT DEFAULT NULL, unidade_armazenamento_id INT DEFAULT NULL, descricao VARCHAR(200) NOT NULL, INDEX IDX_5CAC49D73397707A (categoria_id), INDEX IDX_5CAC49D73066B755 (unidade_armazenamento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_tipo_unidade (produto_id INT NOT NULL, tipo_unidade_id INT NOT NULL, INDEX IDX_2C4C35CC105CFD56 (produto_id), INDEX IDX_2C4C35CC7C72BBB3 (tipo_unidade_id), PRIMARY KEY(produto_id, tipo_unidade_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_unidade_conversao (produto_id INT NOT NULL, unidade_conversao_id INT NOT NULL, INDEX IDX_717B601E105CFD56 (produto_id), INDEX IDX_717B601E928CE448 (unidade_conversao_id), PRIMARY KEY(produto_id, unidade_conversao_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_entrega (id INT AUTO_INCREMENT NOT NULL, produto_necessario_id INT DEFAULT NULL, entrega_id INT DEFAULT NULL, INDEX IDX_DF5304E6703B62 (produto_necessario_id), INDEX IDX_DF5304E67AB91AEC (entrega_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_necessario (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, centro_distribuicao_id INT DEFAULT NULL, quantidade INT NOT NULL, INDEX IDX_143A8F10105CFD56 (produto_id), INDEX IDX_143A8F10BCC3B876 (centro_distribuicao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_posto (id INT AUTO_INCREMENT NOT NULL, produto_id INT DEFAULT NULL, posto_id INT DEFAULT NULL, quantidade INT NOT NULL, INDEX IDX_2EA76DEF105CFD56 (produto_id), INDEX IDX_2EA76DEFCF2DB0E2 (posto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_posto_ajuda (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_unidade (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(60) NOT NULL, valor INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidade_armazenamento (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidade_conversao (id INT AUTO_INCREMENT NOT NULL, unidade_armazenamento_id INT DEFAULT NULL, descricao VARCHAR(150) NOT NULL, valor DOUBLE PRECISION NOT NULL, INDEX IDX_7DC9FFDD3066B755 (unidade_armazenamento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voluntario (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, posto_coleta_id INT DEFAULT NULL, eh_aluno TINYINT(1) NOT NULL, telefone VARCHAR(15) DEFAULT NULL, nome VARCHAR(100) NOT NULL, sobrenome VARCHAR(100) DEFAULT NULL, codigo_area VARCHAR(2) NOT NULL, INDEX IDX_216231FEDB38439E (usuario_id), INDEX IDX_216231FECE458A2B (posto_coleta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voluntario_funcao (voluntario_id INT NOT NULL, funcao_id INT NOT NULL, INDEX IDX_97F66F44BCFA9C0D (voluntario_id), INDEX IDX_97F66F44263E9CB2 (funcao_id), PRIMARY KEY(voluntario_id, funcao_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788F9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788F9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE cidade ADD CONSTRAINT FK_6A98335C9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE entrega ADD CONSTRAINT FK_E56D596B1959881F FOREIGN KEY (motorista_id) REFERENCES motorista (id)');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FA9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FA9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FADA07BCC9 FOREIGN KEY (usuario_responsavel_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda ADD CONSTRAINT FK_BDA3869F9C3F14F3 FOREIGN KEY (posto_ajuda_id) REFERENCES posto_ajuda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda ADD CONSTRAINT FK_BDA3869F10ECDB53 FOREIGN KEY (tipo_posto_ajuda_id) REFERENCES tipo_posto_ajuda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934A9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934A9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73066B755 FOREIGN KEY (unidade_armazenamento_id) REFERENCES unidade_armazenamento (id)');
        $this->addSql('ALTER TABLE produto_tipo_unidade ADD CONSTRAINT FK_2C4C35CC105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_tipo_unidade ADD CONSTRAINT FK_2C4C35CC7C72BBB3 FOREIGN KEY (tipo_unidade_id) REFERENCES tipo_unidade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_unidade_conversao ADD CONSTRAINT FK_717B601E105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_unidade_conversao ADD CONSTRAINT FK_717B601E928CE448 FOREIGN KEY (unidade_conversao_id) REFERENCES unidade_conversao (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E6703B62 FOREIGN KEY (produto_necessario_id) REFERENCES produto_necessario (id)');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E67AB91AEC FOREIGN KEY (entrega_id) REFERENCES entrega (id)');
        $this->addSql('ALTER TABLE produto_necessario ADD CONSTRAINT FK_143A8F10105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produto_necessario ADD CONSTRAINT FK_143A8F10BCC3B876 FOREIGN KEY (centro_distribuicao_id) REFERENCES centro_distribuicao (id)');
        $this->addSql('ALTER TABLE produto_posto ADD CONSTRAINT FK_2EA76DEF105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produto_posto ADD CONSTRAINT FK_2EA76DEFCF2DB0E2 FOREIGN KEY (posto_id) REFERENCES posto_ajuda (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE unidade_conversao ADD CONSTRAINT FK_7DC9FFDD3066B755 FOREIGN KEY (unidade_armazenamento_id) REFERENCES unidade_armazenamento (id)');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FECE458A2B FOREIGN KEY (posto_coleta_id) REFERENCES posto_coleta (id)');
        $this->addSql('ALTER TABLE voluntario_funcao ADD CONSTRAINT FK_97F66F44BCFA9C0D FOREIGN KEY (voluntario_id) REFERENCES voluntario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voluntario_funcao ADD CONSTRAINT FK_97F66F44263E9CB2 FOREIGN KEY (funcao_id) REFERENCES funcao (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788F9586CC8');
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788F9F5A440B');
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788FDB38439E');
        $this->addSql('ALTER TABLE cidade DROP FOREIGN KEY FK_6A98335C9F5A440B');
        $this->addSql('ALTER TABLE entrega DROP FOREIGN KEY FK_E56D596B1959881F');
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FA9586CC8');
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FA9F5A440B');
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FADA07BCC9');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda DROP FOREIGN KEY FK_BDA3869F9C3F14F3');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda DROP FOREIGN KEY FK_BDA3869F10ECDB53');
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934A9586CC8');
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934ADB38439E');
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934A9F5A440B');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73397707A');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73066B755');
        $this->addSql('ALTER TABLE produto_tipo_unidade DROP FOREIGN KEY FK_2C4C35CC105CFD56');
        $this->addSql('ALTER TABLE produto_tipo_unidade DROP FOREIGN KEY FK_2C4C35CC7C72BBB3');
        $this->addSql('ALTER TABLE produto_unidade_conversao DROP FOREIGN KEY FK_717B601E105CFD56');
        $this->addSql('ALTER TABLE produto_unidade_conversao DROP FOREIGN KEY FK_717B601E928CE448');
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E6703B62');
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E67AB91AEC');
        $this->addSql('ALTER TABLE produto_necessario DROP FOREIGN KEY FK_143A8F10105CFD56');
        $this->addSql('ALTER TABLE produto_necessario DROP FOREIGN KEY FK_143A8F10BCC3B876');
        $this->addSql('ALTER TABLE produto_posto DROP FOREIGN KEY FK_2EA76DEF105CFD56');
        $this->addSql('ALTER TABLE produto_posto DROP FOREIGN KEY FK_2EA76DEFCF2DB0E2');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE unidade_conversao DROP FOREIGN KEY FK_7DC9FFDD3066B755');
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FEDB38439E');
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FECE458A2B');
        $this->addSql('ALTER TABLE voluntario_funcao DROP FOREIGN KEY FK_97F66F44BCFA9C0D');
        $this->addSql('ALTER TABLE voluntario_funcao DROP FOREIGN KEY FK_97F66F44263E9CB2');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE centro_distribuicao');
        $this->addSql('DROP TABLE cidade');
        $this->addSql('DROP TABLE entrega');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE funcao');
        $this->addSql('DROP TABLE motorista');
        $this->addSql('DROP TABLE posto_ajuda');
        $this->addSql('DROP TABLE posto_ajuda_tipo_posto_ajuda');
        $this->addSql('DROP TABLE posto_coleta');
        $this->addSql('DROP TABLE produto');
        $this->addSql('DROP TABLE produto_tipo_unidade');
        $this->addSql('DROP TABLE produto_unidade_conversao');
        $this->addSql('DROP TABLE produto_entrega');
        $this->addSql('DROP TABLE produto_necessario');
        $this->addSql('DROP TABLE produto_posto');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tipo_posto_ajuda');
        $this->addSql('DROP TABLE tipo_unidade');
        $this->addSql('DROP TABLE unidade_armazenamento');
        $this->addSql('DROP TABLE unidade_conversao');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE voluntario');
        $this->addSql('DROP TABLE voluntario_funcao');
    }
}
