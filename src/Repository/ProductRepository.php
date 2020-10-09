<?php

namespace App\Repository;

use App\Controller\ProductController;
use App\Entity\Product;
use App\Entity\Section;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findLikeName(?string $search = '', ?Section $section = null, int $page = null)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->setParameter('name', '%' . $search . '%');
        if ($section) {
            $qb->andWhere('p.section = :section')
                ->setParameter('section', $section);
        }
        $qb->orderBy('p.name', 'ASC');

        if (is_numeric($page)) {
            $firstResult = ($page - 1) * ProductController::NB_MAX_PRODUCTS;
            $qb->setFirstResult($firstResult)->setMaxResults((ProductController::NB_MAX_PRODUCTS));
        }

        return $qb->getQuery()->getResult();
    }

    public function findAllSortAndPage($page = null): array
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.name', 'ASC');

        if (is_numeric($page)) {
            $firstResult = ($page - 1) * ProductController::NB_MAX_PRODUCTS;
            $query->setFirstResult($firstResult)->setMaxResults((ProductController::NB_MAX_PRODUCTS));
        }

        return $query->getQuery()->getResult();
    }
}
