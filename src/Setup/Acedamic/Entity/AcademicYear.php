<?php


namespace Vxsoft\Setup\Acedamic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class AcademicYear
 * @package Vxsoft\Setup\Acedamic\Entity
 * @ORM\Table(name="vx_academic_year")
 * @ORM\Entity(repositoryClass="Vxsoft\Setup\Acedamic\Repository\AcademicYearRepository")
 */
class AcademicYear
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $academicYearName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $abbreviation;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $fromDate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    private $toDate;


    use CommonTrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcademicYearName(): ?string
    {
        return $this->academicYearName;
    }

    public function setAcademicYearName(string $academicYearName): self
    {
        $this->academicYearName = $academicYearName;

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

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $adFromDate): self
    {
        $this->fromDate = $adFromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $adToDate): self
    {
        $this->toDate = $adToDate;

        return $this;
    }

    public function __toString()
    {
        return $this->academicYearName;
    }
    use CommonTrait;





}