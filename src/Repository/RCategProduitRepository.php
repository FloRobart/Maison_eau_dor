<?php

namespace App\Repository;

use App\Entity\RCategProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RCategProduit>
 *
 * @method RCategProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RCategProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RCategProduit[]    findAll()
 * @method RCategProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RCategProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RCategProduit::class);
    }

//    /**
//     * @return RCategProduit[] Returns an array of RCategProduit objects
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

//    public function findOneBySomeField($value): ?RCategProduit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
