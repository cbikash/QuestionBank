<?php


namespace Vxsoft\Setup\Acedamic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Level
 * @package Vxsoft\Setup\Acedamic\Repository
 * @ORM\Table(name="vx_university")
 * @ORM\Entity(repositoryClass="Vxsoft\Setup\Acedamic\Repository\UniversityRepository")
 */
class University
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
     * @ORM\Column(type="string", nullable=false)
     *
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @var string | null
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;


    use CommonTrait;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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


}