<?php


namespace Vxsoft\Batch\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class BatchSessionCourse
 * @package Vxsoft\Batch\Entity
 * @ORM\Table(name="vx_batch_session_course")
 * @ORM\Entity(repositoryClass="Vxsoft\Batch\Repository\BatchSessionCourseRepository")
 */
class BatchSessionCourse
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Batch\Entity\BatchSession")
     */
    private $batchSession;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Course\Entity\Course")
     */
    private $course;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBatchSession()
    {
        return $this->batchSession;
    }

    /**
     * @param mixed $batchSession
     */
    public function setBatchSession($batchSession): void
    {
        $this->batchSession = $batchSession;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course): void
    {
        $this->course = $course;
    }


    use CommonTrait;




}