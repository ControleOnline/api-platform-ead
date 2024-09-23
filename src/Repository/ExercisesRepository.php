<?php

namespace ControleOnline\Repository;

use ControleOnline\Entity\Exercises;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Exercises|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercises|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercises[]    findAll()
 * @method Exercises[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExercisesRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Exercises::class);
  }
}
