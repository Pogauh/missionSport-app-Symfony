<?php

namespace App\Repository;

use App\Entity\DetailSeance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailSeance>
 *
 * @method DetailSeance|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailSeance|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailSeance[]    findAll()
 * @method DetailSeance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailSeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailSeance::class);
    }

//    /**
//     * @return DetailSeance[] Returns an array of DetailSeance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailSeance
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
