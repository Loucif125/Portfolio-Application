<?php

namespace App\Repository;

use App\Entity\CookiesConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CookiesConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookiesConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookiesConfig[]    findAll()
 * @method CookiesConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookiesConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookiesConfig::class);
    }

    // /**
    //  * @return CookiesConfig[] Returns an array of CookiesConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CookiesConfig
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
