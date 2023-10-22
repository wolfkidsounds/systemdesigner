<?php

namespace App\Repository;

use App\Entity\Amplifier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Amplifier>
 *
 * @method Amplifier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Amplifier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Amplifier[]    findAll()
 * @method Amplifier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmplifierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Amplifier::class);
    }

    /**
     * @return Amplifier[] Returns an array of Amplifier objects
     */
    public function findByUserOrValidated($User): array
    {
        return $this->createQueryBuilder('amplifier')
            ->andWhere('amplifier.User = :User')
            ->orWhere('amplifier.Validated = :Validated')
            ->setParameter('User', $User)
            ->setParameter('Validated', true)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Amplifier[] Returns an array of Amplifier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Amplifier
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
