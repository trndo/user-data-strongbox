<?php


namespace App\Model;


class CreditCardModel
{
    private ?string $paymentNumber;

    private ?string $cardVerificationCode;

    private ?string $password;

    private ?string $expirationDate;

    private ?string $passPhrase;

    /**
     * @return string|null
     */
    public function getPaymentNumber(): ?string
    {
        return $this->paymentNumber;
    }

    /**
     * @param string|null $paymentNumber
     * @return CreditCardModel
     */
    public function setPaymentNumber(?string $paymentNumber): CreditCardModel
    {
        $this->paymentNumber = $paymentNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardVerificationCode(): ?string
    {
        return $this->cardVerificationCode;
    }

    /**
     * @param string|null $cardVerificationCode
     * @return CreditCardModel
     */
    public function setCardVerificationCode(?string $cardVerificationCode): CreditCardModel
    {
        $this->cardVerificationCode = $cardVerificationCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return CreditCardModel
     */
    public function setPassword(?string $password): CreditCardModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpirationDate(): ?string
    {
        return $this->expirationDate;
    }

    /**
     * @param string|null $expirationDate
     * @return CreditCardModel
     */
    public function setExpirationDate(?string $expirationDate): CreditCardModel
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }

    /**
     * @param string|null $passPhrase
     * @return CreditCardModel
     */
    public function setPassPhrase(?string $passPhrase): CreditCardModel
    {
        $this->passPhrase = $passPhrase;
        return $this;
    }
}