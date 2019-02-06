<?php

namespace App\Repository;

use App\Entity\Ad;
use App\Entity\AdSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function search($search)
    {
        return $this->createQueryBuilder('a');
            if($search['birthday'] != '')
                {
                $query->where('a.birthday = :birthday')
                ->setParameter('birthday', $search['birthday']);
                }
            if($search['birthmonth'] != '')
                {
                $query->andWhere('a.birthmonth = :birthmonth')
                ->setParameter('birthmonth', $search['birthmonth']);
                }
            if($search['birthyear'] != '')
                {
                $query->andWhere('a.birthyear = :birthyear')
                ->setParameter('birthyear', $search['birthyear']);
                }
            if($search['kind'] != '')
                {
                $query->andWhere('a.kind = :kind')
                ->setParameter('kind', $search['kind']);
                }
            if($search['country'] != '')
                {
                $query->andWhere('a.country = :country')
                ->setParameter('country', $search['country']);
                }
            $query->getQuery()
            ->getResult();
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
