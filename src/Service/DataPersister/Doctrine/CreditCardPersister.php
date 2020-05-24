<?php


namespace App\Service\DataPersister\Doctrine;

use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use App\Service\DataPersister\CreditCardPersisterInterface;

class CreditCardPersister implements CreditCardPersisterInterface
{

    public function save(CreditCardModel $creditCardModel): void
    {
        // TODO: Implement save() method.
    }

    public function update(CreditCardModel $creditCardModel, CreditCard $creditCard): void
    {
        // TODO: Implement update() method.
    }

    public function remove(CreditCard $creditCard): void
    {
        // TODO: Implement remove() method.
    }
}