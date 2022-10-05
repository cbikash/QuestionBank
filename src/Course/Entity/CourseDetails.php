<?php


namespace Vxsoft\Course\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class CourseDetails
 * @package Vxsoft\Course\Entity
 * @ORM\Table(name="vx_course_details")
 * @ORM\Entity(repositoryClass="Vxsoft\Course\Repository\CourseDetailsRepository")
 */
class CourseDetails
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
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Course\Entity\Course",inversedBy="details")
     */
    private $course;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Vxsoft\Course\Entity\ElectiveCourse", inversedBy="details")
     */
    private $electiveCourse;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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

    /**
     * @return mixed
     */
    public function getElectiveCourse()
    {
        return $this->electiveCourse;
    }

    /**
     * @param mixed $electiveCourse
     */
    public function setElectiveCourse($electiveCourse): void
    {
        $this->electiveCourse = $electiveCourse;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    use CommonTrait;



}