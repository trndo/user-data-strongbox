<?php

namespace App\Entity;

use App\Repository\PersonalDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;

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
     * @ORM\Column(type="string", length=255)
     */
    private ?string $passportCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $taxIdentificationNumber;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="personalData")
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassportCode(): ?string
    {
        return $this->passportCode;
    }

    public function setPassportCode(string $passportCode): self
    {
        $this->passportCode = $passportCode;

        return $this;
    }

    public function getTaxIdentificationNumber(): ?string
    {
        return $this->taxIdentificationNumber;
    }

    public function setTaxIdentificationNumber(string $taxIdentificationNumber): self
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
