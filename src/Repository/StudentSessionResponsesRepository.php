<?php

namespace ControleOnline\Repository;

use ControleOnline\Entity\StudentSessionResponses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method StudentSessionResponses|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentSessionResponses|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentSessionResponses[]    findAll()
 * @method StudentSessionResponses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentSessionResponsesRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, StudentSessionResponses::class);
  }
}
