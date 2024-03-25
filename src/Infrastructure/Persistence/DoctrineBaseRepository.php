<?php

namespace TableDragon\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;
use Psr\Log\LoggerInterface;

abstract class DoctrineBaseRepository extends EntityRepository
{
    protected LoggerInterface $logger;

    abstract public static function getEntity(): string;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        parent::__construct($em, $em->getClassMetadata(static::getEntity()));
        $this->logger = $logger;
    }

    public function all(int $limit = 100)
    {
        $queryBuilder = $this->createQueryBuilder('im')
            //->orderBy('im.createdAt', 'DESC')
            ->setMaxResults($limit);

        return $queryBuilder->getQuery()->execute();
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?object
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    /**
     * @throws Exception
     *
     * @uses EntityManagerInterface::flush();
     * @uses EntityManagerInterface::persist();
     */
    public function saveObject($object): void
    {
        try {
            $this->getEntityManager()->persist($object);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            $this->logger->error('Fatal Error in DDBB! Message: '.$e->getMessage().' - Object: '.json_encode($object)."\n",
                [
                    'trace' => $e->getTraceAsString(),
                    'object' => dump($object, true),
                ]
            );
            throw new Exception('There is a database problem trying to save the object');
        }
    }

    /**
     * @throws Exception
     *
     * @uses EntityManagerInterface::flush();
     * @uses EntityManagerInterface::persist();
     */
    public function updateClear($object): void
    {
        try {
            $this->getEntityManager()->merge($object); //TODO refactor this funcion, merge not supported in doctrine3
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();
        } catch (Exception $e) {
            $this->logger->error('Fatal Error in DDBB! Message: '.$e->getMessage().' - Object: '.json_encode($object)."\n",
                [
                    'trace' => $e->getTraceAsString(),
                    'object' => print_r($object, true),
                ]
            );
            throw new Exception('There is a database problem trying to update the object');
        }
    }

    /**
     * @throws Exception
     *
     * @uses EntityManagerInterface::flush();
     * @uses EntityManagerInterface::remove();
     */
    public function remove($object): void
    {
        try {
            $this->getEntityManager()->remove($object);
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();
        } catch (Exception $e) {
            $this->logger->error('Fatal Error in DDBB! Message: '.$e->getMessage().' - Object: '.json_encode($object)."\n",
                [
                    'trace' => $e->getTraceAsString(),
                    'object' => print_r($object, true),
                ]
            );
            throw new Exception('There is a database problem trying to remove the object');
        }
    }
}
