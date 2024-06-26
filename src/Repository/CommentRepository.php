<?php

namespace App\Repository;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\Paint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findComments($value)
    {
        if ($value instanceof BlogPost) {
            $object = 'blogPost';
        }

        if ($value instanceof Paint) {
            $object = 'paint';
        }

        return $this->createQueryBuilder('c')
            ->andWhere('c.'.$object.' = :val')
            ->andWhere('c.isPublished = true')
            ->setParameter('val', $value->getId())
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
