<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }


    /**
     * Recherche de produits par nom (titre) avec le %LIKE% de SQL
     *
     * @param string $name
     * @return Produit[]|null
     */
    public function findProduitSimilarByName(string $name, int $categoryId = null, array $orderBy = null, int $limit = null, int $offset = null): ?array
    {
        // Nettoie la chaîne de caractères et empêche l'injection SQL
        $name = trim(str_replace('%', '', strip_tags($name))); // Supprime les espaces, les % (injection SQL), les balises HTML et PHP

        // Création de la requête
        $queryBuilder = $this->createQueryBuilder('p')
        ->andWhere('p.titreProduit LIKE ?0')
        ->setParameter(0, '%' . ($name ?? '') . '%');

        // dd($categoryId);

        // Ajout de l'option par id si spécifiée (ids venant de la catégorie sélectionnée)
        if ($categoryId !== null  && !empty($categoryId)) {
            $queryBuilder->join('p.idCategorie', 'c') // 'c' is an alias for the related 'Categorie' entity
            ->andWhere('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId);
        }

        // dd($queryBuilder->getQuery()->getSQL(), $queryBuilder->getQuery()->getParameters());

        // Ajout de l'option ORDER BY si spécifiée
        if ($orderBy !== null) {
            foreach ($orderBy as $field => $direction) {
                $queryBuilder->addOrderBy('p.' . $field, $direction);
            }
        }

        // Ajout des options LIMIT et OFFSET si spécifiées
        if ($limit !== null || $limit !== 0) {
            $queryBuilder->setMaxResults($limit);
        }

        if ($offset !== null) {
            $queryBuilder->setFirstResult($offset);
        }

        // Si on veut voir la requête SQL générée
        // dd($queryBuilder->getQuery()->getSQL(), $queryBuilder->getQuery()->getParameters(), '%' . $name ?? '' . '%', '%' . ($name ?? '') . '%');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
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

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
