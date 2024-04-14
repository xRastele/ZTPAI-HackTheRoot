<?php

namespace App\Repository;

use App\Entity\LearningPathLesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LearningPathLesson>
 *
 * @method LearningPathLesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method LearningPathLesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method LearningPathLesson[]    findAll()
 * @method LearningPathLesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearningPathLessonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearningPathLesson::class);
    }

    //    /**
    //     * @return LearningPathLesson[] Returns an array of LearningPathLesson objects
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

    //    public function findOneBySomeField($value): ?LearningPathLesson
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
