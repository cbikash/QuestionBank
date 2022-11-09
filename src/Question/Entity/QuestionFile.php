<?php


namespace Vxsoft\Question\Entity;


use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Course
 * @package Vxsoft\Exam\Entity
 * @ORM\Table(name="vx_question_file")
 * @ORM\Entity(repositoryClass="Vxsoft\Question\Repository\QuestionFileRepository")
 */
class QuestionFile
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
   private $fileName;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $fileSize;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $filePath;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $fileOriginalName;



    public function getId(){
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     */
    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string|null
     */
    public function getFileSize(): ?string
    {
        return $this->fileSize;
    }

    /**
     * @param string|null $fileSize
     */
    public function setFileSize(?string $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return string|null
     */
    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    /**
     * @param string|null $filePath
     */
    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    /**
     * @return string|null
     */
    public function getFileOriginalName(): ?string
    {
        return $this->fileOriginalName;
    }

    /**
     * @param string|null $fileOriginalName
     */
    public function setFileOriginalName(?string $fileOriginalName): void
    {
        $this->fileOriginalName = $fileOriginalName;
    }

    use CommonTrait;

}