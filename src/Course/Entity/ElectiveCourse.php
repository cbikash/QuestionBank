<?php


namespace Vxsoft\Course\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class ElectiveCourse
 * @package Vxsoft\Course\Entity
 * @ORM\Table("vx_course_elective")
 * @ORM\Entity(repositoryClass="Vxsoft\Course\Repository\ElectiveCourseRepository")
 */
class ElectiveCourse
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @var string | null
     * @ORM\Column(type="text",  nullable=true)
     */
    private $overview;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Course\Entity\Course", inversedBy="electiveCourses")
     */
    private $course;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Vxsoft\Course\Entity\CourseDetails", mappedBy="electiveCourse")
     */
    private $details;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getOverview(): ?string
    {
        return $this->overview;
    }

    /**
     * @param string|null $overview
     */
    public function setOverview(?string $overview): void
    {
        $this->overview = $overview;
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
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }

    use CommonTrait;


}