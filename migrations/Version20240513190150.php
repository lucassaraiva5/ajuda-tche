<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513190150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE funcao ADD posto_ajuda_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE funcao ADD CONSTRAINT FK_6EDEF13D9C3F14F3 FOREIGN KEY (posto_ajuda_id) REFERENCES posto_ajuda (id)');
        $this->addSql('CREATE INDEX IDX_6EDEF13D9C3F14F3 ON funcao (posto_ajuda_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE funcao DROP FOREIGN KEY FK_6EDEF13D9C3F14F3');
        $this->addSql('DROP INDEX IDX_6EDEF13D9C3F14F3 ON funcao');
        $this->addSql('ALTER TABLE funcao DROP posto_ajuda_id');
    }
}
