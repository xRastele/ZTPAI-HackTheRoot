<?php

namespace App\Repository;

use App\Entity\Progress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Progress>
 *
 * @method Progress|null find($id, $lockMode = null, $lockVersion = null)
 * @method Progress|null findOneBy(array $criteria, array $orderBy = null)
 * @method Progress[]    findAll()
 * @method Progress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Progress::class);
    }

    public function countCompletedChallenges($userId)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->innerJoin('p.user', 'u')
            ->where('u.id = :userId')
            ->andWhere('p.is_completed = true')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getCompletedChallengeIds($userId)
    {
        return $this->createQueryBuilder('p')
            ->select('IDENTITY(p.challenge)')
            ->where('p.user = :userId')
            ->andWhere('p.is_completed = true')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }

    public function getProgressByChallengeIdAndUserId($userId, $challengeId)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.user = :userId')
            ->andWhere('p.challenge = :challengeId')
            ->setParameter('userId', $userId)
            ->setParameter('challengeId', $challengeId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addProgress(Progress $progress): bool
    {
        try {
            $entityManager = $this->getEntityManager();

            $entityManager->persist($progress);
            $entityManager->flush();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
