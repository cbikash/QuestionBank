<?php

namespace Vxsoft\Setup\Acedamic\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Affiliation
 * @package Vxsoft\Setup\Acedamic\Entity
 * @ORM\Table(name="vx_affiliation")
 * @ORM\Entity(repositoryClass="Vxsoft\Setup\Acedamic\Repository\AffiliationRepository")
 */
class Affiliation
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
    private $name;

    /**
     * @var string | null
     * @ORM\Column(type="string")
     */
    private $code;

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

    use CommonTrait;

   public function __toString()
    {
        return $this->name;
    }


}