<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findLikeName(?string $search = '', ?Category $category = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.title LIKE :title')
            ->setParameter('title', '%' . $search . '%');
        if ($category) {
            $qb->andWhere('a.category = :category')
                ->setParameter('category', $category);
        }
        $qb->orderBy('a.date', 'DESC')
            ->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }
}
