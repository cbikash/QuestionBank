<?php


namespace Vxsoft\Exam\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Batch\Entity\Batch;
use Vxsoft\Batch\Entity\BatchSession;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Program\Entity\Program;
use Vxsoft\Setup\Acedamic\Entity\ExamType;

/**
 * Class Course
 * @package Vxsoft\Exam\Entity
 * @ORM\Table(name="vx_exam")
 * @ORM\Entity(repositoryClass="Vxsoft\Exam\Repository\ExamRepository")
 */
class Exam
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
    private $name;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $examYear;

    /**
     * @var ExamType
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\ExamType")
     */
    private $examType;

    /**
     * @var string | null
     * @ORM\Column(type="text", nullable=true)
     */
    private $overview;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Program\Entity\Program")
     */
    private $program;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Batch\Entity\Batch")
     */
    private $batch;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Vxsoft\Batch\Entity\Batch")
     */
    private $batchSession;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ExamCourse", mappedBy="exam")
     */
    private $examCourses;

    /**
     * @ORM\Column(type="text")
     */
    private  $description;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $nonAcademic = false;

    /**
     * @return bool
     */
    public function isNonAcademic(): bool
    {
        return $this->nonAcademic;
    }

    /**
     * @param bool $nonAcademic
     */
    public function setNonAcademic(bool $nonAcademic): void
    {
        $this->nonAcademic = $nonAcademic;
    }



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
    public function getExamYear(): ?string
    {
        return $this->examYear;
    }

    /**
     * @param string|null $examYear
     */
    public function setExamYear(?string $examYear): void
    {
        $this->examYear = $examYear;
    }

    /**
     * @return ExamType
     */
    public function getExamType(): ?ExamType
    {
        return $this->examType;
    }

    /**
     * @param ExamType $examType
     */
    public function setExamType(ExamType $examType): void
    {
        $this->examType = $examType;
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
    public function getProgram() : ?Program
    {
        return $this->program;
    }

    /**
     * @param mixed $program
     */
    public function setProgram(Program $program): void
    {
        $this->program = $program;
    }

    /**
     * @return mixed
     */
    public function getBatch() : ?Batch
    {
        return $this->batch;
    }

    /**
     * @param mixed $batch
     */
    public function setBatch(Batch $batch): void
    {
        $this->batch = $batch;
    }

    /**
     * @return mixed
     */
    public function getBatchSession() : ?BatchSession
    {
        return $this->batchSession;
    }

    /**
     * @param mixed $batchSession
     */
    public function setBatchSession(BatchSession $batchSession): void
    {
        $this->batchSession = $batchSession;
    }

    /**
     * @return mixed
     */
    public function getExamCourses() : ?ExamCourse
    {
        return $this->examCourses;
    }

    /**
     * @param mixed $examCourses
     */
    public function setExamCourses($examCourses): void
    {
        $this->examCourses = $examCourses;
    }

    /**
     * @return mixed
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }



    use CommonTrait;







}