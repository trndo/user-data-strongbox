<?php


namespace App\Service\DataPersister;

use App\Entity\PersonalData;
use App\Entity\User;
use App\Model\PersonalDataModel;

interface PersonalDataPersisterInterface
{
    public function save(PersonalDataModel $personalDataModel, User $user): void;

    public function update(PersonalDataModel $personalDataModel, PersonalData $personalData, User $user): void;

    public function remove(PersonalData $personalData): void;
}