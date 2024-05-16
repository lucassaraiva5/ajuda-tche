<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516173623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E6703B62');
        $this->addSql('DROP INDEX IDX_DF5304E6703B62 ON produto_entrega');
        $this->addSql('ALTER TABLE produto_entrega ADD quantidade DOUBLE PRECISION NOT NULL, CHANGE produto_necessario_id produto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E6105CFD56 FOREIGN KEY (produto_id) REFERENCES produto (id)');
        $this->addSql('CREATE INDEX IDX_DF5304E6105CFD56 ON produto_entrega (produto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto_entrega DROP FOREIGN KEY FK_DF5304E6105CFD56');
        $this->addSql('DROP INDEX IDX_DF5304E6105CFD56 ON produto_entrega');
        $this->addSql('ALTER TABLE produto_entrega DROP quantidade, CHANGE produto_id produto_necessario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produto_entrega ADD CONSTRAINT FK_DF5304E6703B62 FOREIGN KEY (produto_necessario_id) REFERENCES produto_necessario (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DF5304E6703B62 ON produto_entrega (produto_necessario_id)');
    }
}
