<?php

namespace App\Service;

use App\Entity\Tree;
use App\Enum\TreeType;
use App\Repository\TreeRepository;
use Doctrine\ORM\EntityManagerInterface;

class FruitGardenService
{
    private EntityManagerInterface $entityManager;
    private TreeRepository $treeRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        TreeRepository         $treeRepository
    )
    {
        $this->treeRepository = $treeRepository;
        $this->entityManager = $entityManager;
    }


    public function createTree(
        TreeType $typeTree,
        int $numberOfTrees,
        int $minQuantityFruits,
        int $maxQuantityFruits
    ): void
    {
        for ($i = 1; $i <= $numberOfTrees; $i++) {
            $tree = new Tree();
            $this->entityManager->persist($tree);
            $tree->setCategory($typeTree->value);
            $tree->setNumberOfFruits(rand($minQuantityFruits, $maxQuantityFruits));
        }
        $this->entityManager->flush();
    }


    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countTree(TreeType $treeType): int
    {
        $queryBuilder = $this->treeRepository->createQueryBuilder('t');

        $queryBuilder
            ->andWhere('t.category =:tree')
            ->setParameter('tree', $treeType->value);


        return (int)$queryBuilder
            ->select('count(t.category)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countFruits(TreeType $treeType): int
    {
        $queryBuilder = $this->treeRepository->createQueryBuilder('t');

        $queryBuilder
            ->andWhere('t.category =:tree')
            ->setParameter('tree', $treeType->value);

        return (int)$queryBuilder
            ->select('sum(t.numberOfFruits)')
            ->getQuery()
            ->getSingleScalarResult();
    }

}