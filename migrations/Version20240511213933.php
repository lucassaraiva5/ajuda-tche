<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\TipoUnidade;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511213933 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $em;

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        
        $arrayUnidades = [
            'Litro',
            'Quilograma',
            'Unidade',
            'Caixa',
            'Peça',
            'Par',
            'Pacote',
            'Fardo',
            'Metro',
            'Duzia',
            'Conjunto',
        ];

        foreach ($arrayUnidades as $unidade) {
            $tipoUnidade = new TipoUnidade();
            $tipoUnidade->setDescricao($unidade);
            $this->em->persist($tipoUnidade);
        }

        $this->em->flush();

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
