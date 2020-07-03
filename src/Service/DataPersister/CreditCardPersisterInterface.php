<?php


namespace App\Service\DataPersister;


use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use Symfony\Component\Security\Core\User\UserInterface;

interface CreditCardPersisterInterface
{
    public function save(CreditCardModel $creditCardModel, UserInterface $user): void;

    public function update(CreditCardModel $creditCardModel, CreditCard $creditCard, UserInterface $user): void;

    public function remove(CreditCard $creditCard): void;
}