<?php

namespace App\Entity;

use App\Repository\PersonalDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use phpDocumentor\Reflection\Types\Resource_;

/**
 * @ORM\Entity(repositoryClass=PersonalDataRepository::class)
 */
class PersonalData
{
    use Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $passportCode;

    /**
     * @ORM\Column(type="blob")
     */
    private $taxIdentificationNumber;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="personalData")
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return resource
     */
    public function getPassportCode()
    {
        return $this->passportCode;
    }

    /**
     * @param resource $passportCode
     * @return $this
     */
    public function setPassportCode($passportCode): self
    {
        $this->passportCode = $passportCode;

        return $this;
    }

    /**
     * @return resource
     */
    public function getTaxIdentificationNumber()
    {
        return $this->taxIdentificationNumber;
    }

    /**
     * @param resource $taxIdentificationNumber
     * @return $this
     */
    public function setTaxIdentificationNumber($taxIdentificationNumber): self
    {
        $this->taxIdentificationNumber = $taxIdentificationNumber;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
