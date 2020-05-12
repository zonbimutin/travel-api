<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\DBALException

abstract class BaseRespository
{

  private ManagerRegistry $managerRegistry;

  protected ObjectRepository $objectRepository;

  protected Connection $connection;



  function __construct(ManagerRegistry $managerRegistry, Connection $connection)
  {
    $this->managerRegistry = $managerRegistry;
    $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    $this->connection = $connection;

  }

  abstract protected static function entityClass(): string;


  protected function saveEntity($entity): void
  {
    $this->getEntityManager()->persist($entity);
    $this->getEntityManager()->flush();

  }

  protected function removeEntity($entity): void
  {
    $this->getEntityManager()->remove($entity);
    $this->getEntityManager()->flush();

  }


  protected function createQueryBuilder(): QueryBuilder
  {
    return $this->getEntityManager()->createQueryBuilder();
  }


  /**
  * @throws DBALException
  */
  protected function executeFetchQuery(string $query, array $params = []): array
  {
    return $this->connection->executeQuery($query, $params)->fetchAll();
  }
  /**
  * @throws DBALException
  */
  protected function executeInsertQuery(string $query, array $params = []): void
  {
    $this->connection->executeQuery($query, $params);
  }


  private function getEntityManager(): ObjectManager
  {
    $entityManager = $this->managerRegistry->getManager();

    if ($entityManager->isOpen()) {
      return $entityManager;
    }

    return $this->managerRegistry->resetManager();
  }


}





 ?>
