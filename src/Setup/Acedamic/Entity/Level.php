<?php


namespace Vxsoft\Setup\Acedamic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Level
 * @package Vxsoft\Setup\Acedamic\Repository
 * @ORM\Table(name="vx_level")
 * @ORM\Entity(repositoryClass="Vxsoft\Setup\Acedamic\Repository\LevelRepository")
 */
class Level
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


}