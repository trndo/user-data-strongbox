<?php


namespace App\DataMapper;

use App\Entity\CreditCard;
use App\Model\CreditCardModel;

final class CreditCardMapper
{
    public static function fromModelToArray(CreditCardModel $creditCardModel): array
    {
        return (array) $creditCardModel;
    }

    public static function fromArrayToModel(array $data): CreditCardModel
    {
        return $model = new CreditCardModel();
    }

    public static function fromModelToEntity(
        CreditCardModel $creditCardModel,
        CreditCard $entity
    ): CreditCard {
        return $entity->setCardVerificationCode($creditCardModel->cardVerificationCode)
            ->setExpirationDate($creditCardModel->expirationDate)
            ->setPassPhrase($creditCardModel->passPhrase)
            ->setCardVerificationCode($creditCardModel->cardVerificationCode)
            ->setPassword($creditCardModel->password);
    }

}