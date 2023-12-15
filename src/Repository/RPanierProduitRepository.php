<?php

namespace App\Repository;

use App\Entity\RPanierProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RPanierProduit>
 *
 * @method RPanierProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RPanierProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RPanierProduit[]    findAll()
 * @method RPanierProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RPanierProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RPanierProduit::class);
    }

//    /**
//     * @return RPanierProduit[] Returns an array of RPanierProduit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RPanierProduit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
