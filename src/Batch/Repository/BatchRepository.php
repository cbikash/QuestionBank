<?php


namespace Vxsoft\Batch\Repository;


use Doctrine\ORM\EntityRepository;
use Vxsoft\Batch\Entity\Batch;

class BatchRepository extends EntityRepository
{
    public function getAllQuery($filters = []){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('b')
            ->from(Batch::class,'b')
            ->where('b.deleted = 0');
        return $qb;
    }

}