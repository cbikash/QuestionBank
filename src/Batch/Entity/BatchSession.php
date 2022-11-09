<?php


namespace Vxsoft\Batch\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class BatchSession
 * @package Vxsoft\Batch\Entity
 * @ORM\Table(name="vx_batch_session")
 * @ORM\Entity(repositoryClass="Vxsoft\Batch\Repository\BatchSessionRepository")
 */
class BatchSession
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
    private $type;
    /**
     * @var string | null
     * @ORM\Column(type="integer")
     */
    private $session;

    /**
     * @var Batch
     * @ORM\ManyToOne(targetEntity="Vxsoft\Batch\Entity\Batch", inversedBy="batchSessions")
     */
    private $batch;

    /**
     * @var \DateTime | null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $toDate;

    /**
     * @var \DateTime | null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fromDate;

    /**
     * @var BatchSessionCourse
     * @ORM\OneToMany(targetEntity="Vxsoft\Batch\Entity\BatchSessionCourse", mappedBy="batchSession")
     */
    private $batchSessionCourses;

    public function __construct()
    {
        $this->batchSessionCourses = new ArrayCollection();
    }

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
     * @return string|null
     */
    public function getSession(): ?string
    {
        return $this->session;
    }

    /**
     * @param string|null $session
     */
    public function setSession(?string $session): void
    {
        $this->session = $session;
    }

    /**
     * @return Batch
     */
    public function getBatch(): Batch
    {
        return $this->batch;
    }

    /**
     * @param Batch $batch
     */
    public function setBatch(Batch $batch): void
    {
        $this->batch = $batch;
    }

    /**
     * @return \DateTime|null
     */
    public function getToDate(): ?\DateTime
    {
        return $this->toDate;
    }

    /**
     * @param \DateTime|null $toDate
     */
    public function setToDate(?\DateTime $toDate): void
    {
        $this->toDate = $toDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getFromDate(): ?\DateTime
    {
        return $this->fromDate;
    }

    /**
     * @param \DateTime|null $fromDate
     */
    public function setFromDate(?\DateTime $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getBatchSessionCourses(){
        return $this->batchSessionCourses->filter(function (BatchSessionCourse $batchSessionCourse){
            return $batchSessionCourse->isDeleted() == false;
        });
    }

    public function addBatchSessionCourse(BatchSessionCourse $batchSessionCourse){
        if(!($this->batchSessionCourses->contains($batchSessionCourse))){
            $this->batchSessionCourses->add($batchSessionCourse);

        }
        return $this;
    }

    public function removeBatchSessionCourse(BatchSessionCourse $batchSessionCourse){
        if($this->batchSessionCourses->contains($batchSessionCourse)){
            $this->batchSessionCourses->removeElement($batchSessionCourse);
        }
        return $this;
    }


    public function __toString()
    {
        return 'Session-'.$this->session;
    }


    use CommonTrait;




}