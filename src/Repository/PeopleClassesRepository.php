<?php

namespace ControleOnline\Repository;

use ControleOnline\Entity\PeopleClasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method PeopleClasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeopleClasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeopleClasses[]    findAll()
 * @method PeopleClasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleClassesRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, PeopleClasses::class);
  }
}
