<?php


namespace App\DataMapper;

use App\Entity\CreditCard;
use App\Model\CreditCardModel;

final class CreditCardMapper
{
    public static function fromEntityToModel(CreditCard $creditCard): CreditCardModel
    {
        $model = new CreditCardModel();
        $model->paymentNumber = stream_get_contents($creditCard->getPaymentNumber());
        $model->password = stream_get_contents($creditCard->getPassword());
        $model->cardVerificationCode = stream_get_contents($creditCard->getCardVerificationCode());
        $model->passPhrase = stream_get_contents($creditCard->getPassPhrase());
        $model->expirationDate = stream_get_contents($creditCard->getExpirationDate());

        return $model;
    }

    public static function fromModelToEntity(
        CreditCardModel $creditCardModel,
        CreditCard $entity
    ): CreditCard {
        return $entity->setCardVerificationCode($creditCardModel->cardVerificationCode)
            ->setExpirationDate($creditCardModel->expirationDate)
            ->setPassPhrase($creditCardModel->passPhrase)
            ->setPassword($creditCardModel->password)
            ->setPaymentNumber($creditCardModel->paymentNumber);
    }

}