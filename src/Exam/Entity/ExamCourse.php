<?php


namespace Vxsoft\Exam\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Course\Entity\Course;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Question\Entity\Question;

/**
 * Class Course
 * @package Vxsoft\Exam\Entity
 * @ORM\Table(name="vx_exam_course")
 * @ORM\Entity(repositoryClass="Vxsoft\Exam\Repository\ExamCourseRepository")
 */
class ExamCourse
{

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Course
     * @ORM\OneToOne(targetEntity="Vxsoft\Course\Entity\Course")
     */
    private $course;

    /**
     * @var Exam
     * @ORM\ManyToOne(targetEntity="Vxsoft\Exam\Entity\Exam", inversedBy="examCourses")
     */
    private $exam;

    /**
     * @var Question
     * @ORM\OneToMany(targetEntity="Vxsoft\Question\Entity\Question", mappedBy="examCourse")
     */
    private $questions;

    /**
     * @var string | null
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var int | null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fullMarks;

    /**
     * @var int | null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passMarks;


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
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @param Exam $exam
     */
    public function setExam(Exam $exam): void
    {
        $this->exam = $exam;
    }

    /**
     * @return Question
     */
    public function getQuestions(): Question
    {
        return $this->questions;
    }

    /**
     * @param Question $questions
     */
    public function setQuestions(Question $questions): void
    {
        $this->questions = $questions;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getFullMarks(): ?int
    {
        return $this->fullMarks;
    }

    /**
     * @param int|null $fullMarks
     */
    public function setFullMarks(?int $fullMarks): void
    {
        $this->fullMarks = $fullMarks;
    }

    /**
     * @return int|null
     */
    public function getPassMarks(): ?int
    {
        return $this->passMarks;
    }

    /**
     * @param int|null $passMarks
     */
    public function setPassMarks(?int $passMarks): void
    {
        $this->passMarks = $passMarks;
    }



    use CommonTrait;







}