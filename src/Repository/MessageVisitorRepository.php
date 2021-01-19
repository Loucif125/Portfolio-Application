<?php

namespace App\Repository;

use App\Entity\MessageVisitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MessageVisitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageVisitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageVisitor[]    findAll()
 * @method MessageVisitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageVisitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageVisitor::class);
    }

    // /**
    //  * @return MessageVisitor[] Returns an array of MessageVisitor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageVisitor
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
