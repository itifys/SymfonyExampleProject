<?php

namespace App\Repository;

use App\Entity\QuestionairePart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionairePart|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionairePart|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionairePart[]    findAll()
 * @method QuestionairePart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionairePartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionairePart::class);
    }

    // /**
    //  * @return QuestionairePart[] Returns an array of QuestionairePart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionairePart
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
