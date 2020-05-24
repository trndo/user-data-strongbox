<?php


namespace App\Service\DataPersister;

use App\Entity\PersonalData;
use App\Model\PersonalDataModel;

interface PersonalDataPersisterInterface
{
    public function save(PersonalDataModel $personalDataModel): void;

    public function update(PersonalDataModel $personalDataModel, PersonalData $personalData): void;

    public function remove(PersonalData $personalData): void;
}