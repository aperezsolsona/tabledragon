<?php

declare(strict_types=1);

namespace TableDragon\Infrastructure\Persistence;

use TableDragon\Domain\Player\Player;
use TableDragon\Domain\Player\PlayerRepositoryInterface;
use TableDragon\Domain\Player\PlayerSearchCriteria;

final class PlayerRepository extends DoctrineBaseRepository implements PlayerRepositoryInterface
{
    public static function getEntity(): string
    {
        return Player::class;
    }

    public function search(PlayerSearchCriteria $criteria)
    {
        $qb = $this->createQueryBuilder('e');

        // Example: Add keyword search condition
        if ($criteria->getKeyword()) {
            $qb->orWhere('ILIKE(e.name,:keyword) = TRUE')
                ->orWhere('ILIKE(e.surname,:keyword) = TRUE')
                ->orWhere('ILIKE(e.number,:keyword) = TRUE')
                ->setParameter('keyword', '%' . $criteria->getKeyword() . '%');
        }

        // Apply ordering
        $qb->orderBy('e.' . $criteria->getOrderBy(), $criteria->getOrderDirection());

        // Apply pagination
        $qb->setFirstResult(($criteria->getPage() - 1) * $criteria->getPerPage())
            ->setMaxResults($criteria->getPerPage());

        return $qb->getQuery()->getResult();
    }

    public function totalResults(PlayerSearchCriteria $criteria): int
    {
        $qb = $this->createQueryBuilder('e')->select('COUNT(e.id)');

        if ($criteria->getKeyword()) {
            $qb->orWhere('ILIKE(e.name,:keyword) = TRUE')
                ->orWhere('ILIKE(e.surname,:keyword) = TRUE')
                ->orWhere('ILIKE(e.number,:keyword) = TRUE')
                ->setParameter('keyword', '%' . $criteria->getKeyword() . '%');
        }

        return $qb->getQuery()->getSingleScalarResult();
    }
}