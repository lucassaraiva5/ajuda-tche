<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516193022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrega ADD posto_ajuda_destino_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrega ADD CONSTRAINT FK_E56D596B4D4C9A05 FOREIGN KEY (posto_ajuda_destino_id) REFERENCES posto_ajuda (id)');
        $this->addSql('CREATE INDEX IDX_E56D596B4D4C9A05 ON entrega (posto_ajuda_destino_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrega DROP FOREIGN KEY FK_E56D596B4D4C9A05');
        $this->addSql('DROP INDEX IDX_E56D596B4D4C9A05 ON entrega');
        $this->addSql('ALTER TABLE entrega DROP posto_ajuda_destino_id');
    }
}
