<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513000157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posto_ajuda (id INT AUTO_INCREMENT NOT NULL, cidade_id INT DEFAULT NULL, estado_id INT DEFAULT NULL, usuario_responsavel_id INT NOT NULL, descricao VARCHAR(300) NOT NULL, INDEX IDX_4D8C46FA9586CC8 (cidade_id), INDEX IDX_4D8C46FA9F5A440B (estado_id), INDEX IDX_4D8C46FADA07BCC9 (usuario_responsavel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posto_ajuda_tipo_posto_ajuda (posto_ajuda_id INT NOT NULL, tipo_posto_ajuda_id INT NOT NULL, INDEX IDX_BDA3869F9C3F14F3 (posto_ajuda_id), INDEX IDX_BDA3869F10ECDB53 (tipo_posto_ajuda_id), PRIMARY KEY(posto_ajuda_id, tipo_posto_ajuda_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_posto_ajuda (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FA9586CC8 FOREIGN KEY (cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FA9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE posto_ajuda ADD CONSTRAINT FK_4D8C46FADA07BCC9 FOREIGN KEY (usuario_responsavel_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda ADD CONSTRAINT FK_BDA3869F9C3F14F3 FOREIGN KEY (posto_ajuda_id) REFERENCES posto_ajuda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda ADD CONSTRAINT FK_BDA3869F10ECDB53 FOREIGN KEY (tipo_posto_ajuda_id) REFERENCES tipo_posto_ajuda (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FA9586CC8');
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FA9F5A440B');
        $this->addSql('ALTER TABLE posto_ajuda DROP FOREIGN KEY FK_4D8C46FADA07BCC9');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda DROP FOREIGN KEY FK_BDA3869F9C3F14F3');
        $this->addSql('ALTER TABLE posto_ajuda_tipo_posto_ajuda DROP FOREIGN KEY FK_BDA3869F10ECDB53');
        $this->addSql('DROP TABLE posto_ajuda');
        $this->addSql('DROP TABLE posto_ajuda_tipo_posto_ajuda');
        $this->addSql('DROP TABLE tipo_posto_ajuda');
    }
}
