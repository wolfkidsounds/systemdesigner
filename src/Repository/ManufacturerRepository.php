<?php

namespace App\Repository;

use App\Entity\Manufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Manufacturer>
 *
 * @method Manufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manufacturer[]    findAll()
 * @method Manufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    /**
     * @return Manufacturer[] Returns an array of Manufacturer objects
     */
    public function findByUserOrValidated($User): array
    {
        return $this->createQueryBuilder('manufacturer')
            ->andWhere('manufacturer.User = :User')
            ->orWhere('manufacturer.Validated = :Validated')
            ->setParameter('User', $User)
            ->setParameter('Validated', true)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Manufacturer[] Returns an array of Manufacturer objects
     */
    public function findByUserOrValidatedWithCategory($User, $Category): array
    {
        return $this->createQueryBuilder('manufacturer')
            ->andWhere('manufacturer.User = :User')
            ->orWhere('manufacturer.Validated = :Validated')
            ->andWhere('manufacturer.Category LIKE :Category')
            ->setParameter('User', $User)
            ->setParameter('Validated', true)
            ->setParameter('Category', '%' . $Category . '%')
            ->getQuery()
            ->getResult()
        ;
    }
}
