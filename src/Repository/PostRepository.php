<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    //Top 5 tendances sur la journée
    public function findTopTrending(int $limit = 5): array{

        return $this->createQueryBuilder('p')
            ->leftJoin('p.likes', 'l')
            ->addSelect('COUNT(l.id) AS HIDDEN likeCount')
            ->groupBy('p.id')
            ->orderBy('likeCount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();


    }

    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();
    }

    public function findFeedForUser(User $user): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.author', 'u')
            ->innerJoin('u.followers', 'f')
            ->where('f.id = :userId')
            ->setParameter('userId', $user->getId())
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();
    }

    public function searchByKeyword(string $keyword): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.ContenuDuKweek LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
