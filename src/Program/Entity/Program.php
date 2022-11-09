<?php


namespace Vxsoft\Program\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Batch\Entity\Batch;
use Vxsoft\Main\MainTrait\CommonTrait;
use Vxsoft\Setup\Acedamic\Entity\Affiliation;
use Vxsoft\Setup\Acedamic\Entity\Faculty;
use Vxsoft\Setup\Acedamic\Entity\Level;
use Vxsoft\Setup\Acedamic\Entity\ProgramSystem;
use Vxsoft\Setup\Acedamic\Entity\University;

/**
 * Class Program
 * @package Vxsoft\Program\Entity
 * @ORM\Table(name="vx_program")
 * @ORM\Entity(repositoryClass="Vxsoft\Program\Repository\ProgramRepository")
 */
class Program
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
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $abbreviation;

    /**
     * @var Affiliation | null
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\Affiliation")
     */
    private $affiliation;

    /**
     * @var Faculty | null
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\Faculty")
     */
    private $faculty;

    /**
     * @var Level | null
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\Level")
     */
    private $level;

    /**
     * @var University | null
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\University")
     */
    private $university;

    /**
     * @var ProgramSystem
     * @ORM\ManyToOne(targetEntity="Vxsoft\Setup\Acedamic\Entity\ProgramSystem")
     */
    private $system;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Vxsoft\Batch\Entity\Batch", mappedBy="program")
     */
    private $batches;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $MaxDuration;

    public function __construct()
    {
        $this->batches = new ArrayCollection();
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     */
    public function setAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }

    /**
     * @return Affiliation|null
     */
    public function getAffiliation(): ?Affiliation
    {
        return $this->affiliation;
    }

    /**
     * @param Affiliation|null $affiliation
     */
    public function setAffiliation(?Affiliation $affiliation): void
    {
        $this->affiliation = $affiliation;
    }

    /**
     * @return Faculty|null
     */
    public function getFaculty(): ?Faculty
    {
        return $this->faculty;
    }

    /**
     * @param Faculty|null $faculty
     */
    public function setFaculty(?Faculty $faculty): void
    {
        $this->faculty = $faculty;
    }

    /**
     * @return Level|null
     */
    public function getLevel(): ?Level
    {
        return $this->level;
    }

    /**
     * @param Level|null $level
     */
    public function setLevel(?Level $level): void
    {
        $this->level = $level;
    }

    /**
     * @return University|null
     */
    public function getUniversity(): ?University
    {
        return $this->university;
    }

    /**
     * @param University|null $university
     */
    public function setUniversity(?University $university): void
    {
        $this->university = $university;
    }

    /**
     * @return ProgramSystem | null
     */
    public function getSystem(): ?ProgramSystem
    {
        return $this->system;
    }

    /**
     * @param ProgramSystem $system
     */
    public function setSystem(?ProgramSystem $system): void
    {
        $this->system = $system;
    }

    /**
     * @return int
     */
    public function getMaxDuration(): int
    {
        return $this->MaxDuration;
    }

    /**
     * @param int $MaxDuration
     */
    public function setMaxDuration(int $MaxDuration): void
    {
        $this->MaxDuration = $MaxDuration;
    }



    public function getTotalSessions(): int
    {
        $totalSessions = 0;
        $programSystem = $this->getSystem();

        if ($programSystem instanceof ProgramSystem) {
            $duration = $programSystem->getDuration();
            $session = $programSystem->getNumberOfSession();
            $totalSessions = $duration * $session;
        }

        return $totalSessions;
    }

    /**
     * @return ArrayCollection
     */
    public function getBatches()
    {
        return $this->batches;
    }

    /**
     * @param ArrayCollection $batches
     */
    public function setBatches(ArrayCollection $batches): void
    {
        $this->batches = $batches;
    }

    public function addBatch(?Batch $batch){
        if(!$this->batches->contains($batch)){
            $this->batches->add($batch);
            $batch->setProgram($this);
        }
    }

    public function removeBatch(?Batch $batch){
        if($this->batches->contains($batch)){
            $this->batches->removeElement($batch);
            $batch->setProgram(null);
        }
    }

    public function __toString()
    {
      return $this->title;
    }


    use CommonTrait;




}