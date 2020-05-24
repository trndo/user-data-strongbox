<?php


namespace App\Service\DataPersister;


use App\Entity\CreditCard;
use App\Model\CreditCardModel;

interface CreditCardPersisterInterface
{
    public function save(CreditCardModel $creditCardModel): void;

    public function update(CreditCardModel $creditCardModel, CreditCard $creditCard): void;

    public function remove(CreditCard $creditCard): void;
}