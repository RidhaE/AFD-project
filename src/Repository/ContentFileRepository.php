<?php

namespace App\Repository;

use App\Entity\ContentFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContentFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContentFile::class);
    }
    public function paginator(int $page, int $maxResults, $slug): Paginator
    {
        $qb = $this->createQueryBuilder('c')         
            ->andWhere('c.image = :slug')
            ->setParameter('slug', $slug);

        $qb
            ->setFirstResult(($page - 1) * $maxResults)
            ->setMaxResults($maxResults);
       

        return new Paginator($qb);
    }
    public function getDatabyFile($slug): array
    {
            return $this->createQueryBuilder('c')
            ->andWhere('c.image = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()->getResult();
    }
}
