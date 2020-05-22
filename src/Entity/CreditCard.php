<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=CreditCardRepository::class)
 */
class CreditCard
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
    private ?string $paymentNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $cardVerificationCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $expirationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $passPhrase;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentNumber(): ?int
    {
        return $this->paymentNumber;
    }

    public function setPaymentNumber(string $paymentNumber): self
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    public function getCardVerificationCode(): ?string
    {
        return $this->cardVerificationCode;
    }

    public function setCardVerificationCode(string $cardVerificationCode): self
    {
        $this->cardVerificationCode = $cardVerificationCode;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(string $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }

    public function setPassPhrase(string $passPhrase): self
    {
        $this->passPhrase = $passPhrase;

        return $this;
    }
}
