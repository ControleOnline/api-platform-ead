<?php

namespace ControleOnline\Repository;

use ControleOnline\Entity\StudentSessions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method StudentSessions|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentSessions|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentSessions[]    findAll()
 * @method StudentSessions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentSessionsRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, StudentSessions::class);
  }
}
