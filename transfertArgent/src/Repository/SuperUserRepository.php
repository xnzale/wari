<?php

namespace App\Repository;

use App\Entity\SuperUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuperUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperUser[]    findAll()
 * @method SuperUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuperUser::class);
    }

    // /**
    //  * @return SuperUser[] Returns an array of SuperUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuperUser
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
