<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514011211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE desalojado ADD desalojado_tipo_abrigo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE desalojado ADD CONSTRAINT FK_872A9212F1A699B5 FOREIGN KEY (desalojado_tipo_abrigo_id) REFERENCES desalojado_tipo_abrigo (id)');
        $this->addSql('CREATE INDEX IDX_872A9212F1A699B5 ON desalojado (desalojado_tipo_abrigo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE desalojado DROP FOREIGN KEY FK_872A9212F1A699B5');
        $this->addSql('DROP INDEX IDX_872A9212F1A699B5 ON desalojado');
        $this->addSql('ALTER TABLE desalojado DROP desalojado_tipo_abrigo_id');
    }
}
