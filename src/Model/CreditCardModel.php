<?php


namespace App\Model;


class CreditCardModel
{
    public ?string $paymentNumber;

    public ?string $cardVerificationCode;

    public ?string $password;

    public ?string $expirationDate;

    public ?string $passPhrase;
}