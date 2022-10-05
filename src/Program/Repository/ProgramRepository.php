<?php


namespace Vxsoft\Program\Repository;


use Doctrine\ORM\EntityRepository;
use Vxsoft\Program\Entity\Program;

class ProgramRepository extends EntityRepository
{

    public function getAllQuery($filters = [], $select_ = null){
        $select = $select_ ?? 'p';
        $qb = $this->_em->createQueryBuilder();
        $qb->select($select)
            ->from(Program::class, 'p')
            ->where('p.deleted =0');

        return $qb;
    }
}