<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513192752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FECE458A2B');
        $this->addSql('DROP INDEX IDX_216231FECE458A2B ON voluntario');
        $this->addSql('ALTER TABLE voluntario CHANGE posto_coleta_id posto_ajuda_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FE9C3F14F3 FOREIGN KEY (posto_ajuda_id) REFERENCES posto_ajuda (id)');
        $this->addSql('CREATE INDEX IDX_216231FE9C3F14F3 ON voluntario (posto_ajuda_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voluntario DROP FOREIGN KEY FK_216231FE9C3F14F3');
        $this->addSql('DROP INDEX IDX_216231FE9C3F14F3 ON voluntario');
        $this->addSql('ALTER TABLE voluntario CHANGE posto_ajuda_id posto_coleta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voluntario ADD CONSTRAINT FK_216231FECE458A2B FOREIGN KEY (posto_coleta_id) REFERENCES posto_coleta (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_216231FECE458A2B ON voluntario (posto_coleta_id)');
    }
}
