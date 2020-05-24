<?php


namespace App\Service\DataPersister;


use App\Entity\CreditCard;
use App\Entity\User;
use App\Model\CreditCardModel;

interface CreditCardPersisterInterface
{
    public function save(CreditCardModel $creditCardModel, User $user): void;

    public function update(CreditCardModel $creditCardModel, CreditCard $creditCard, User $user): void;

    public function remove(CreditCard $creditCard): void;
}