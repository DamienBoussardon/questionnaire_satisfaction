<?php

namespace App\Repository;

use App\Entity\Reply;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reply|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reply|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reply[]    findAll()
 * @method Reply[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReplyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reply::class);
    }

    // /**
    //  * @return Reply[] Returns an array of Response objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reply
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findReplyBySurveyAndPersonSurveyed($survey, $personSurvey): ?Reply
    {
        return $this->createQueryBuilder('r')
            ->where('r.survey = :s')
            ->andWhere('r.personSurveyed = :p')
            ->setParameter('s', $survey)
            ->setParameter('p', $personSurvey)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
