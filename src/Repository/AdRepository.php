<?php

namespace App\Repository;

use App\Entity\Ad;
use App\Entity\AdSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * 
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function search($criteria)
    {
        $qb = $this->createQueryBuilder('a');       
            if($criteria->getBirthDay() != '')
                {
                $qb->andwhere('a.birthDay = :birthday')
                ->setParameter('birthday', $criteria->getBirthDay()); 
                }
            if($criteria->getBirthMonth() != '')
                {
                $qb->andWhere('a.birthMonth = :birthmonth')
                ->setParameter('birthmonth', $criteria->getBirthMonth());
                }
            if($criteria->getBirthYear() != '')
                {
                $qb->andWhere('a.birthYear = :birthyear')
                ->setParameter('birthyear', $criteria->getBirthYear());
                }
            if($criteria->getKind() != '')
                {
                $qb->andWhere('a.kind = :kind')
                ->setParameter('kind', $criteria->getKind());
                }
            if($criteria->getDepartment() != '')
                {
                $qb->andWhere('a.department = :department')
                ->setParameter('department', $criteria->getDepartment());
                }
            if($criteria->getCountry() != '')
                {
                $qb->andWhere('a.country = :country')
                ->setParameter('country', $criteria->getCountry());
                }
            $query = $qb->getQuery();
            return $query->getResult();
    }


    // /**
    //  * @return Ad[] Returns an array of Ad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
