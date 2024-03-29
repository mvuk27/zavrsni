<?php

namespace App\Repository;

use App\Entity\Courses;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Courses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Courses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Courses[]    findAll()
 * @method Courses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Courses::class);
    }

    public function getRestCourses(User $user)
    {
        $userId = $user->getId();
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "SELECT courses.id, courses.name 
                from courses 
                left outer join user_courses uc 
                on courses.id = uc.courses_id 
                where uc.user_id is null or uc.user_id <> $userId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $results;
    }
}
