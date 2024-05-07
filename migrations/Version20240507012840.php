<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Categoria;
use App\Entity\Produto;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507012840 extends AbstractMigration implements ContainerAwareInterface
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

        $categorias = [
            'Higiene Pessoal' => [
                'Pasta de dente',
                'Escova de dente',
                'Sabonete',
                'Shampoo',
                'Condicionador',
                'Enxaguante Bucal',
                'Fio Dental',
                'Laminas de barbear',
                'Lenços Umedecidos',
                'Fraldas',
                'Absorvente'
            ],
            'Cama/Mesa/Banho' => [
                'Toalha de banho',
                'Cobertor',
                'Colchão de Berço',
                'Colchão de solteiro',
                'Colchão de Casal',
                'Lençol',
                'Travesseiro',
                'Pano de prato',
                'Copo',
                'Garfo',
                'Faca',
                'Colher',
                'Prato'
            ],
            'Bebidas' => [
                'Composto para Bebe (Até 6 meses)',
                'Composto para Bebe (6 meses - 1 Ano)',
                'Fórmula infantil 1 ano+',
                'Leite',
                'Leite sem lactose',
                'Agua',
                'Água com gás',
                'Refrigerante',
                'Suco',
                'Isotonico'
            ],
            'Alimentos' => [
                'Cesta básica',
                'Farinha de Trigo',
                'Macarrão/massa',
                'Arroz',
                'Feijão',
                'Café',
                'Bolacha/biscoito',
                'Achocolatado em pó',
                'Milho',
                'Ervilha',
                'Seleta de legumes',
                'Pessego enlatado',
                'Abacaxi enlatado',
                'Sardinha',
                'Feijão enlatado',
                'Atum',
                'Bacon',
                'Salame',
            ],
            'Produtos de Limpeza' => [
                'Agua Sanitária',
                'Alcool',
                'Desinfetante',
                'Detergente',
                'Rodo',
                'Vassoura',
                'Aromatizador',
                'Esfregão/mop',
                'Sabão em pó',
                'Amaciante',
                'Sabão em barra',
                'Desengordurante',
            ],
            'Medicamentos/Saude' => [
                'Paracetamol (Tylenol, Vicky Pyrena, Dorfen)',
                'Dipirona (Dorflex, Neusaodina, Benegripe)',
                'Ibuprofeno (Advil, Alivium, Buscofem, Artril)',
                'Ácido Acetilsalicílico (AAS, Aspirina, Bufferin, Melhoral, AS-Med)',
                'Insulina',
                'Termometro',
                'Esfigmomanômetro (Aparelho de medir pressão)',
                'Medidor de glicose',
                'Oximetro',
                'Nebulizador',
                'Agua oxigenada',
                'Gaze',
                'Algodão',
                'Esparadrapo',
                'Soro Fisiológico',
                'Bandagem Adesiva',
                'Desfibrilador',
                'Estetoscopio',
                'Chá',
                'Codeina (Tylex)',
                'Rispiridona',
                'Clonazepam (Rivotril)',
                'Losartana potássica',
                'Fenobarbital (GARDENAL)',
                'Nimesulida (Cimelid, Nimesilam, Nimelit, Nisoflan, Cataflan, Deltaflan)',
                'Amoxicilina + Clavulanato de potássio',
                'Antiseptico Nasal',
                'Anticoncepcional'
            ],
            'Itens em geral' => [
                'Brinquedos',
                'Outro'
            ]
        ];

        foreach ($categorias as $categoriaDescrição => $itens) {
            $categoria = new Categoria();
            $categoria->setDescricao($categoriaDescrição);
            $this->em->persist($categoria);

            foreach ($itens as $item) {
                $produto = new Produto();
                $produto->setDescricao($item);
                $produto->setCategoria($categoria);
                $this->em->persist($produto);
            }
            
        }

        
        $this->em->flush();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
