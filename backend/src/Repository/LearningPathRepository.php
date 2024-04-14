<?php

namespace App\Repository;

use App\Entity\LearningPath;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LearningPath>
 *
 * @method LearningPath|null find($id, $lockMode = null, $lockVersion = null)
 * @method LearningPath|null findOneBy(array $criteria, array $orderBy = null)
 * @method LearningPath[]    findAll()
 * @method LearningPath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearningPathRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningPath::class);
    }

    //    /**
    //     * @return LearningPath[] Returns an array of LearningPath objects
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

    //    public function findOneBySomeField($value): ?LearningPath
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
