<?php


namespace Vxsoft\Question\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Setup\Acedamic\Entity\QuestionType;

/**
 * Class Course
 * @package Vxsoft\Exam\Entity
 * @ORM\Table(name="vx_question")
 * @ORM\Entity(repositoryClass="Vxsoft\Question\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\ManyToOne(targetEntity="Vxsoft\Exam\Entity\ExamCourse", inversedBy="questions")
     */
    private $examCourse;


    /**
     * @var string | null
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive = true;

    /**
     * @var QuestionType | null
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\QuestionType")
     */
    private $questionType;

    /**
     * @var QuestionFile | null
     * @ORM\ManyToMany(targetEntity="Vxsoft\Question\Entity\QuestionFile", mappedBy="")
     */
    private $questionFiles;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getExamCourse()
    {
        return $this->examCourse;
    }

    /**
     * @param mixed $examCourse
     */
    public function setExamCourse($examCourse): void
    {
        $this->examCourse = $examCourse;
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return QuestionType|null
     */
    public function getQuestionType(): ?QuestionType
    {
        return $this->questionType;
    }

    /**
     * @param QuestionType|null $questionType
     */
    public function setQuestionType(?QuestionType $questionType): void
    {
        $this->questionType = $questionType;
    }

    /**
     * @return QuestionFile|null
     */
    public function getQuestionFiles(): ?QuestionFile
    {
        return $this->questionFiles;
    }

    /**
     * @param QuestionFile|null $questionFiles
     */
    public function setQuestionFiles(?QuestionFile $questionFiles): void
    {
        $this->questionFiles = $questionFiles;
    }


    use CommonTrait;
}