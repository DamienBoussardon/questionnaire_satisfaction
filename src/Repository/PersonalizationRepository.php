<?php

namespace App\Repository;

use App\Entity\Personalization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Personalization|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personalization|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personalization[]    findAll()
 * @method Personalization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonalizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personalization::class);
    }
    

    public function findPersonalizationByUserId($value): ?Personalization
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Personalization[] Returns an array of Personalization objects
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

    /*
    public function findOneBySomeField($value): ?Personalization
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
