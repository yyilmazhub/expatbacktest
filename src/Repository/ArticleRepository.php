<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * Crée une nouvelle instance de l'entité Article.
     *
     * @return Article
     */
    public function new(): Article
    {
        return new Article();
    }

    /**
     * Ajoute une entité Article à la base de données.
     *
     * @param Article $entity L'entité Article à ajouter
     * @param bool $flush Spécifie si la base de données doit être mise à jour immédiatement 
     */
    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
    /**
     * Retourne un tableau d'objets Article en fonction du nom de catégorie.
     *
     * @param string $categoryName Le nom de la catégorie
     * @return Article[] Le tableau d'objets Article
     */
    public function findByField(?string $categoryName): array
    {
        $queryBuilder = $this->createQueryBuilder('a');

        if ($categoryName !== 'all') {
            $queryBuilder
                ->innerJoin('a.category', 'c')
                ->andWhere('c.name = :categoryName')
                ->setParameter('categoryName', $categoryName);
        }

        return $queryBuilder
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
