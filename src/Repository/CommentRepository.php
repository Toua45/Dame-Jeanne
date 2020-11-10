<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findChosenComment($slug): array
    {
        $query = $this->createQueryBuilder('c')
            ->join('c.article', 'a')
            ->where("a.slug = :slug")
            ->andWhere("c.chosenComment = 1")
            ->orderBy('c.date', 'DESC')
            ->setParameter('slug', $slug);

        return $query->getQuery()->getResult();
    }

    public function findCommentsByDate(): array
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.date', 'DESC');

        return $query->getQuery()->getResult();
    }
}
