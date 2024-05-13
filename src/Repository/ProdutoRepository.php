<?php

namespace App\Repository;

use App\Entity\Produto;
use App\Repository\Interfaces\AppRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produto>
 */
class ProdutoRepository extends ServiceEntityRepository implements AppRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produto::class);
    }

    // public function createProdutoQueryBuilder(string $descricao = null): QueryBuilder
    // {
    //     $queryBuilder = $this->addOrderByDescriçãoQueryBuilder();
    //     if ($descricao) {
    //         $queryBuilder->andWhere('mix.genre = :genre')
    //             ->setParameter('genre', $genre);
    //     }
    //     return $queryBuilder;
    // }

    //    /**
    //     * @return Produto[] Returns an array of Produto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produto
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
