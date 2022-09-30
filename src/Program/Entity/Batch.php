<?php


namespace Vxsoft\Program\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Setup\Acedamic\Entity\AcademicSession;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;

/**
 * Class Batch
 * @package Vxsoft\Program\Entity
 * @ORM\Table(name="vx_batch")
 * @ORM\Entity(repositoryClass="Vxsoft\Program\Repository\BatchRepository")
 */
class Batch
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var AcademicYear
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\AcademicYear")
     */
    private $academicYear;

    /**
     * @var AcademicSession
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\AcademicSession")
     */
    private $academicSession;

    use CommonTrait;

}