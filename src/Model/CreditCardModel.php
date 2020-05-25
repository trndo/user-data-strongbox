<?php


namespace App\Model;


class CreditCardModel
{
    public ?string $paymentNumber = null;

    public ?string $cardVerificationCode = null;

    public ?string $password = null;

    public ?string $expirationDate = null;

    public ?string $passPhrase = null;

    public ?string $userKey = null;
}