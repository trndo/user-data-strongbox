<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use phpDocumentor\Reflection\Types\Resource_;

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
     * @ORM\Column(type="blob")
     */
    private $paymentNumber;

    /**
     * @ORM\Column(type="blob")
     */
    private $cardVerificationCode;

    /**
     * @ORM\Column(type="blob")
     */
    private $password;

    /**
     * @ORM\Column(type="blob")
     */
    private $expirationDate;

    /**
     * @ORM\Column(type="blob")
     */
    private $passPhrase;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="creditCards")
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return resource
     */
    public function getPaymentNumber()
    {
        return $this->paymentNumber;
    }

    public function setPaymentNumber(Resource_ $paymentNumber): self
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    public function getCardVerificationCode(): ?Resource_
    {
        return $this->cardVerificationCode;
    }

    public function setCardVerificationCode(Resource_ $cardVerificationCode): self
    {
        $this->cardVerificationCode = $cardVerificationCode;

        return $this;
    }

    public function getPassword(): ?Resource_
    {
        return $this->password;
    }

    public function setPassword(Resource_ $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getExpirationDate(): ?Resource_
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(Resource_ $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getPassPhrase(): ?Resource_
    {
        return $this->passPhrase;
    }

    public function setPassPhrase(Resource_ $passPhrase): self
    {
        $this->passPhrase = $passPhrase;

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
