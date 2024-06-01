<?php

namespace App\Repository;

use App\Entity\Leaderboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Leaderboard>
 *
 * @method Leaderboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Leaderboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Leaderboard[]    findAll()
 * @method Leaderboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeaderboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Leaderboard::class);
    }

    public function findAllUsernamePoints()
    {
        return $this->createQueryBuilder('l')
            ->select('u.username, l.points')
            ->join('l.user', 'u')
            ->orderBy('l.points', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findPointsByUserId($userId)
    {
        return $this->createQueryBuilder('l')
            ->select('l.points')
            ->where('l.user = :userId')
            ->setParameter('userId', $userId)
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    //    /**
    //     * @return Leaderboard[] Returns an array of Leaderboard objects
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

    //    public function findOneBySomeField($value): ?Leaderboard
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
