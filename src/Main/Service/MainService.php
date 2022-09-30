<?php


namespace Vxsoft\Main\Service;


use Doctrine\ORM\EntityManagerInterface;

class MainService
{

   public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }

    public function softDelete($entity){
        try{
            $entity->setDeleted(true);
            $this->em->persist($entity);
            $this->em->flush();
            return 'successfully deleted';
        }catch (\Throwable $exception){
            return  $exception->getMessage();
        }

    }

}