<?php


namespace Vxsoft\Course\Repository;


use Doctrine\ORM\EntityRepository;
use Vxsoft\Course\Entity\Course;

class CourseRepository extends EntityRepository
{
    public function getQuery($filters = [])
    {
       $qb = $this->_em->createQueryBuilder();
       $qb->select('c')
           ->from(Course::class, 'c')
           ->where('c.deleted = 0')


       ;
       return $qb;

    }

}