<?php

namespace App\Repository;

use App\Entity\Limiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Limiter>
 *
 * @method Limiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Limiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Limiter[]    findAll()
 * @method Limiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LimiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Limiter::class);
    }

//    /**
//     * @return Limiter[] Returns an array of Limiter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Limiter
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
