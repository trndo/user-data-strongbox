<?php


namespace App\Service\DataPersister\Doctrine;


use App\Entity\PersonalData;
use App\Model\CreditCardModel;
use App\Model\PersonalDataModel;
use App\Service\DataPersister\PersonalDataPersisterInterface;

class PersonalDataPersister implements PersonalDataPersisterInterface
{

    public function save(PersonalDataModel $personalDataModel): void
    {
        // TODO: Implement save() method.
    }

    public function update(PersonalDataModel $personalDataModel, PersonalData $personalData): void
    {
        // TODO: Implement update() method.
    }

    public function remove(PersonalData $personalData): void
    {
        // TODO: Implement remove() method.
    }
}