<?php


namespace App\Service\DataProvider;

use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use Symfony\Component\Security\Core\User\UserInterface;

interface CreditCardProviderInterface
{
    public function getCreditCards(UserInterface $user): ?array;

    public function getCreditCardModel(CreditCard $creditCard): CreditCardModel;
}