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

    /**
     * @param resource $paymentNumber
     * @return $this
     */
    public function setPaymentNumber($paymentNumber)
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    /**
     * @return resource
     */
    public function getCardVerificationCode()
    {
        return $this->cardVerificationCode;
    }

    /**
     * @param resource $cardVerificationCode
     * @return $this
     */
    public function setCardVerificationCode($cardVerificationCode): self
    {
        $this->cardVerificationCode = $cardVerificationCode;

        return $this;
    }

    /**
     * @return resource
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param resource $password
     * @return $this
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return resource
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param resource $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return resource
     */
    public function getPassPhrase()
    {
        return $this->passPhrase;
    }

    /**
     * @param resource $passPhrase
     * @return $this
     */
    public function setPassPhrase($passPhrase): self
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
