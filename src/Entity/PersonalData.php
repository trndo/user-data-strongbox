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
    private Resource_ $passportCode;

    /**
     * @ORM\Column(type="blob")
     */
    private Resource_ $taxIdentificationNumber;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="personalData")
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassportCode()
    {
        return $this->passportCode;
    }

    public function setPassportCode(Resource_ $passportCode): self
    {
        $this->passportCode = $passportCode;

        return $this;
    }

    public function getTaxIdentificationNumber(): Resource_
    {
        return $this->taxIdentificationNumber;
    }

    public function setTaxIdentificationNumber(Resource_ $taxIdentificationNumber): self
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
