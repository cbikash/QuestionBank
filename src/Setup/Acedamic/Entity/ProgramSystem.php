<?php


namespace Vxsoft\Setup\Acedamic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class ProgramSystem
 * @package Vxsoft\Setup\Acedamic\Entity
 * @ORM\Table(name="vx_program_system")
 * @ORM\Entity(repositoryClass="Vxsoft\Setup\Acedamic\Repository\ProgramSystemRepository")
 */
class ProgramSystem
{

    public const PROGRAM_ANNUAL = "ANNUAL";
    public const PROGRAM_SEMESTER = "SEMESTER";

    public static $programSystemType = [
        self::PROGRAM_ANNUAL => "Annual",
        self::PROGRAM_SEMESTER => "Semester"
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
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     */
    private $abbreviation;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private $durationType;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=2)
     * @Assert\Length(max="2")
     * @Assert\NotBlank()
     */
    private $duration;


    /**
     * @var integer
     * @ORM\Column(type="integer", length=1)
     * @Assert\LessThanOrEqual(value="5")
     */
    private $numberOfSession = 1;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Vxsoft\Program\Entity\Program", mappedBy="system")
     */
    private $programs;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $programType;

    use CommonTrait;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getDurationType(): ?string
    {
        return $this->durationType;
    }

    public function setDurationType(string $durationType): self
    {
        $this->durationType = $durationType;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getNumberOfSession(): ?int
    {
        return $this->numberOfSession;
    }

    /**
     * @param int $numberOfSession
     * @return self
     */
    public function setNumberOfSession($numberOfSession): self
    {
        $this->numberOfSession = $numberOfSession;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrograms()
    {
        return $this->programs;
    }

    /**
     * @param ArrayCollection $programs
     * @return self
     */
    public function setPrograms($programs): self
    {
        $this->programs = $programs;
        return $this;
    }

    /**
     * @return string
     */
    public function getProgramType()
    {
        return $this->programType;
    }

    /**
     * @param string $programType
     */
    public function setProgramType(?string $programType)
    {
        $this->programType = $programType;
    }

    public function getType()
    {
        return $this->title;
    }

    public function __toString()
    {
        if ($this->abbreviation and $this->abbreviation != '') {
            return $this->abbreviation;
        }

        return $this->title;
    }

}