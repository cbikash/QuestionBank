<?php


namespace Vxsoft\Batch\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Program\Entity\Program;
use Vxsoft\Setup\Acedamic\Entity\AcademicSession;
use Vxsoft\Setup\Acedamic\Entity\AcademicYear;

/**
 * Class Batch
 * @package Vxsoft\Program\Entity
 * @ORM\Table(name="vx_batch")
 * @ORM\Entity(repositoryClass="Vxsoft\Batch\Repository\BatchRepository")
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
     * @var string | null
     * @ORM\Column(type="string", nullable=true)
     */
    private $code;

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

    /**
     * @var ArrayCollection | []
     * @ORM\OneToMany(targetEntity="BatchSession", mappedBy="batch",orphanRemoval=true, )
     */
    private $batchSessions;

    /**
     * @var Program
     * @ORM\ManyToOne(targetEntity="Vxsoft\Program\Entity\Program", inversedBy="batches")
     */
    private $program;

    public function __construct()
    {
        $this->batchSessions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return AcademicYear | null
     */
    public function getAcademicYear(): ?AcademicYear
    {
        return $this->academicYear;
    }

    /**
     * @param AcademicYear $academicYear
     */
    public function setAcademicYear(?AcademicYear $academicYear): void
    {
        $this->academicYear = $academicYear;
    }

    /**
     * @return AcademicSession
     */
    public function getAcademicSession(): ?AcademicSession
    {
        return $this->academicSession;
    }

    /**
     * @param AcademicSession $academicSession
     */
    public function setAcademicSession(?AcademicSession $academicSession): void
    {
        $this->academicSession = $academicSession;
    }

    /**
     * @return ArrayCollection | []
     */
    public function getBatchSessions()
    {
        return $this->batchSessions;
    }

    /**
     * @param mixed $batchSessions
     */
    public function setBatchSessions($batchSessions): void
    {
        $this->batchSessions = $batchSessions;
    }

    public function addBatchSession(BatchSession $batchSession): self{
        if(!($this->batchSessions->contains($batchSession))){
            $this->batchSessions->add($batchSession);
            $batchSession->setBatch($this);
        }
        return $this;
    }

    public function removeBatchSession($batchSession){
        if($this->batchSessions->contains($batchSession)){
            $this->batchSessions->removeElement($batchSession);
            $batchSession->setBatch(null);
        }
        return $this;
    }

    /**
     * @return Program
     */
    public function getProgram(): Program
    {
        return $this->program;
    }

    /**
     * @param Program $program
     */
    public function setProgram(Program $program): void
    {
        $this->program = $program;
    }

    public function __toString()
    {
       return $this->title;
    }





    use CommonTrait;


}