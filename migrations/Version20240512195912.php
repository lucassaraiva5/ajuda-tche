<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512195912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unidade_conversao (id INT AUTO_INCREMENT NOT NULL, descricao VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produto ADD unidade_conversao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D7928CE448 FOREIGN KEY (unidade_conversao_id) REFERENCES unidade_conversao (id)');
        $this->addSql('CREATE INDEX IDX_5CAC49D7928CE448 ON produto (unidade_conversao_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D7928CE448');
        $this->addSql('DROP TABLE unidade_conversao');
        $this->addSql('DROP INDEX IDX_5CAC49D7928CE448 ON produto');
        $this->addSql('ALTER TABLE produto DROP unidade_conversao_id');
    }
}
