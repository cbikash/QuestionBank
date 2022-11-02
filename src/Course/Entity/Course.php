<?php


namespace Vxsoft\Course\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Course
 * @package Vxsoft\Course\Entity
 * @ORM\Table(name="vx_course")
 * @ORM\Entity(repositoryClass="Vxsoft\Course\Repository\CourseRepository")
 */
class Course
{
   CONST COURSE_TYPE_ELECTIVE = "ELECTIVE";
   CONST COURSE_TYPE_COMPULSORY = "COMPULSORY";

  static $courses  = [
      self::COURSE_TYPE_ELECTIVE => "ELECTIVE",
      self::COURSE_TYPE_COMPULSORY => "COMPULSORY",
       ];

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
    private $name;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @var string | null
     * @ORM\Column(type="text", nullable=true)
     */
    private $overview;


    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $type = Course::COURSE_TYPE_COMPULSORY;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="Vxsoft\Course\Entity\ElectiveCourse", mappedBy="course")
     */
    private $electiveCourses;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="Vxsoft\Course\Entity\CourseDetails", mappedBy="course")
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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
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
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getElectiveCourses()
    {
        return $this->electiveCourses;
    }

    /**
     * @param mixed $electiveCourses
     */
    public function setElectiveCourses($electiveCourses): void
    {
        $this->electiveCourses = $electiveCourses;
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

    public function __toString()
    {
        return $this->name;
    }

    use CommonTrait;





    

}