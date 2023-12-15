<?php

namespace App\Repository;

use App\Entity\RFormatProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RFormatProduit>
 *
 * @method RFormatProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RFormatProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RFormatProduit[]    findAll()
 * @method RFormatProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RFormatProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RFormatProduit::class);
    }

//    /**
//     * @return RFormatProduit[] Returns an array of RFormatProduit objects
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

//    public function findOneBySomeField($value): ?RFormatProduit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
