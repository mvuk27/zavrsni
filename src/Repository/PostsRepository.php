<?php

namespace App\Repository;

use App\Entity\Posts;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    public function savePost(Posts $posts)
    {
        $this->getEntityManager()->persist($posts);
        $this->getEntityManager()->flush();
        return $posts;
    }
}
