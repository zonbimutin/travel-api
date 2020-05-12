<?php

namespace App\Repository;

use App\Entity\DestinationComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DestinationComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DestinationComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DestinationComment[]    findAll()
 * @method DestinationComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DestinationComment::class);
    }

    // /**
    //  * @return DestinationComment[] Returns an array of DestinationComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DestinationComment
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
