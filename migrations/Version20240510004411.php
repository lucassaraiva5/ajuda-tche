<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510004411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE centro_distribuicao ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE centro_distribuicao ADD CONSTRAINT FK_EBE1788FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_EBE1788FDB38439E ON centro_distribuicao (usuario_id)');
        $this->addSql('ALTER TABLE posto_coleta ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posto_coleta ADD CONSTRAINT FK_2BDC934ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_2BDC934ADB38439E ON posto_coleta (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posto_coleta DROP FOREIGN KEY FK_2BDC934ADB38439E');
        $this->addSql('DROP INDEX IDX_2BDC934ADB38439E ON posto_coleta');
        $this->addSql('ALTER TABLE posto_coleta DROP usuario_id');
        $this->addSql('ALTER TABLE centro_distribuicao DROP FOREIGN KEY FK_EBE1788FDB38439E');
        $this->addSql('DROP INDEX IDX_EBE1788FDB38439E ON centro_distribuicao');
        $this->addSql('ALTER TABLE centro_distribuicao DROP usuario_id');
    }
}
