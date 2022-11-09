<?php


namespace Vxsoft\Question\Entity;


use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Course
 * @package Vxsoft\Exam\Entity
 * @ORM\Table(name="vx_sub_question")
 * @ORM\Entity(repositoryClass="Vxsoft\Question\Repository\SubQuestionRepository")
 */
class SubQuestion
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive = true;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Vxsoft\Question\Entity\QuestionFile")
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