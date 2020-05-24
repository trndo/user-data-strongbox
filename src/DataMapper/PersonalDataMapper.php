<?php


namespace App\DataMapper;


use App\Entity\PersonalData;
use App\Model\PersonalDataModel;

final class PersonalDataMapper
{
    public static function fromModelToArray(PersonalDataModel $personalDataModel): array
    {
        return (array) $personalDataModel;
    }

    public static function fromArrayToModel(array $data): PersonalDataModel
    {
       return $model = new PersonalDataModel();
    }

    public static function fromModelToEntity(
        PersonalDataModel $personalDataModel,
        PersonalData $entity
    ): PersonalData {
        return $entity->setPassportCode($personalDataModel->passportCode)
                    ->setTaxIdentificationNumber($personalDataModel->taxIdentificationNumber);
    }
}