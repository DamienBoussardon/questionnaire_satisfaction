<?php

namespace App\Repository;

use App\Entity\PersonSurveyed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonSurveyed|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonSurveyed|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonSurveyed[]    findAll()
 * @method PersonSurveyed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonSurveyedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonSurveyed::class);
    }

    // /**
    //  * @return PersonSurveyed[] Returns an array of PersonSurveyed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findOneByEmail($value): ?PersonSurveyed
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.email = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?PersonSurveyed
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
}
