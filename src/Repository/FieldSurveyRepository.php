<?php

namespace App\Repository;

use App\Entity\FieldSurvey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FieldSurvey|null find($id, $lockMode = null, $lockVersion = null)
 * @method FieldSurvey|null findOneBy(array $criteria, array $orderBy = null)
 * @method FieldSurvey[]    findAll()
 * @method FieldSurvey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldSurveyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FieldSurvey::class);
    }

    // /**
    //  * @return FieldSurvey[] Returns an array of FieldSurvey objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findAllFieldSurvayBySurveyId($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.survey = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?FieldSurvey
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
