<?php


namespace App\Service\DataProvider;


use App\Entity\User;

interface CreditCardProviderInterface
{
    public function getCreditCards(User $user): ?array;
}