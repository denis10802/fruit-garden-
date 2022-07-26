<?php

namespace App\Repository;

use App\Entity\Tree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tree>
 *
 * @method Tree|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tree|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tree[]    findAll()
 * @method Tree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tree::class);
    }

    public function add(Tree $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tree $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
