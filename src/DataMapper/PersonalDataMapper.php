<?php


namespace App\DataMapper;


use App\Entity\PersonalData;
use App\Model\PersonalDataModel;

final class PersonalDataMapper
{
    public static function fromEntityToModel(PersonalData $personalData): PersonalDataModel
    {
        $model = new PersonalDataModel();
        $model->taxIdentificationNumber = stream_get_contents($personalData->getTaxIdentificationNumber());
        $model->passportCode = stream_get_contents($personalData->getPassportCode());

        return $model;
    }


    public static function fromModelToEntity(
        PersonalDataModel $personalDataModel,
        PersonalData $entity
    ): PersonalData {
        return $entity->setPassportCode($personalDataModel->passportCode)
            ->setTaxIdentificationNumber($personalDataModel->taxIdentificationNumber);
    }


}