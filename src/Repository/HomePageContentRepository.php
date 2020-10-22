<?php

namespace App\Repository;

use App\Entity\HomePageContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomePageContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomePageContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomePageContent[]    findAll()
 * @method HomePageContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomePageContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomePageContent::class);
    }

    // /**
    //  * @return HomePageContent[] Returns an array of HomePageContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomePageContent
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
