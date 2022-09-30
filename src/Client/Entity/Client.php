<?php


namespace Vxsoft\Client\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vxsoft\Main\MainTrait\CommonTrait;

/**
 * Class Client
 * @package App\Client\Entity
 * @ORM\Entity(repositoryClass="Vxsoft\Client\Repository\ClientRepository")
 * @ORM\Table(name="vx_client")
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $firstName;

    /**
     * @var string | null
     * @ORM\Column(type="string", nullable=true)
     */
    private $middleName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $fullName;

    /**
     * @var integer | null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $registerAs;

    /**
     * @var string | null
     * @ORM\Column(type="string", nullable=true)
     */
    private $profile;

    use CommonTrait;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string|null $middleName
     */
    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int|null
     */
    public function getRegisterAs(): ?int
    {
        return $this->registerAs;
    }

    /**
     * @param int|null $registerAs
     */
    public function setRegisterAs(?int $registerAs): void
    {
        $this->registerAs = $registerAs;
    }

    /**
     * @return string|null
     */
    public function getProfile(): ?string
    {
        return $this->profile;
    }

    /**
     * @param string|null $profile
     */
    public function setProfile(?string $profile): void
    {
        $this->profile = $profile;
    }



}