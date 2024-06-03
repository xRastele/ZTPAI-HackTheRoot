<?php

namespace App\Repository;

use App\Entity\Challenge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Challenge>
 *
 * @method Challenge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Challenge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Challenge[]    findAll()
 * @method Challenge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Challenge::class);
    }

    public function getRandomIncompleteChallengesIdAndTitle($userId, $challengeIds, $limit = 2)
    {
        $challenges = $this->createQueryBuilder('c')
            ->select('c.id', 'c.title')
            ->where('c.id IN (:challengeIds)')
            ->setParameter('challengeIds', $challengeIds)
            ->getQuery()
            ->getResult();

        shuffle($challenges);

        return array_slice($challenges, 0, $limit);
    }

    public function findAllIds()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id')
            ->getQuery()
            ->getResult();
    }
}
