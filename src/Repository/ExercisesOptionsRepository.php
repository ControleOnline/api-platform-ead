<?php

namespace ControleOnline\Repository;

use ControleOnline\Entity\ExercisesOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method ExercisesOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExercisesOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExercisesOptions[]    findAll()
 * @method ExercisesOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExercisesOptionsRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, ExercisesOptions::class);
  }
}
