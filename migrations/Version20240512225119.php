<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240512225119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produto_tipo_unidade (produto_id INT NOT NULL, tipo_unidade_id INT NOT NULL, INDEX IDX_2C4C35CC105CFD56 (produto_id), INDEX IDX_2C4C35CC7C72BBB3 (tipo_unidade_id), PRIMARY KEY(produto_id, tipo_unidade_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produto_unidade_conversao (produto_id INT NOT NULL, unidade_conversao_id INT NOT NULL, INDEX IDX_717B601E105CFD56 (produto_id), INDEX IDX_717B601E928CE448 (unidade_conversao_id), PRIMARY KEY(produto_id, unidade_conversao_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produto_tipo_unidade ADD CONSTRAINT FK_2C4C35CC105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_tipo_unidade ADD CONSTRAINT FK_2C4C35CC7C72BBB3 FOREIGN KEY (tipo_unidade_id) REFERENCES tipo_unidade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_unidade_conversao ADD CONSTRAINT FK_717B601E105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto_unidade_conversao ADD CONSTRAINT FK_717B601E928CE448 FOREIGN KEY (unidade_conversao_id) REFERENCES unidade_conversao (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D7928CE448');
        $this->addSql('DROP INDEX IDX_5CAC49D7928CE448 ON produto');
        $this->addSql('ALTER TABLE produto CHANGE unidade_conversao_id unidade_armazenamento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73066B755 FOREIGN KEY (unidade_armazenamento_id) REFERENCES unidade_armazenamento (id)');
        $this->addSql('CREATE INDEX IDX_5CAC49D73066B755 ON produto (unidade_armazenamento_id)');
        $this->addSql('ALTER TABLE unidade_conversao ADD unidade_armazenamento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unidade_conversao ADD CONSTRAINT FK_7DC9FFDD3066B755 FOREIGN KEY (unidade_armazenamento_id) REFERENCES unidade_armazenamento (id)');
        $this->addSql('CREATE INDEX IDX_7DC9FFDD3066B755 ON unidade_conversao (unidade_armazenamento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto_tipo_unidade DROP FOREIGN KEY FK_2C4C35CC105CFD56');
        $this->addSql('ALTER TABLE produto_tipo_unidade DROP FOREIGN KEY FK_2C4C35CC7C72BBB3');
        $this->addSql('ALTER TABLE produto_unidade_conversao DROP FOREIGN KEY FK_717B601E105CFD56');
        $this->addSql('ALTER TABLE produto_unidade_conversao DROP FOREIGN KEY FK_717B601E928CE448');
        $this->addSql('DROP TABLE produto_tipo_unidade');
        $this->addSql('DROP TABLE produto_unidade_conversao');
        $this->addSql('ALTER TABLE unidade_conversao DROP FOREIGN KEY FK_7DC9FFDD3066B755');
        $this->addSql('DROP INDEX IDX_7DC9FFDD3066B755 ON unidade_conversao');
        $this->addSql('ALTER TABLE unidade_conversao DROP unidade_armazenamento_id');
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73066B755');
        $this->addSql('DROP INDEX IDX_5CAC49D73066B755 ON produto');
        $this->addSql('ALTER TABLE produto CHANGE unidade_armazenamento_id unidade_conversao_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D7928CE448 FOREIGN KEY (unidade_conversao_id) REFERENCES unidade_conversao (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5CAC49D7928CE448 ON produto (unidade_conversao_id)');
    }
}
