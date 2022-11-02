<?php


namespace Vxsoft\Course\Repository;


use Doctrine\ORM\EntityRepository;
use Vxsoft\Course\Entity\ElectiveCourse;

class ElectiveCourseRepository extends EntityRepository
{
    public function getAllQuery($filters = []){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from(ElectiveCourse::class,'c')
            ->where('c.deleted = 0');
        return $qb;
    }

}