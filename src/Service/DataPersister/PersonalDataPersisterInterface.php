<?php


namespace App\Service\DataPersister;

use App\Entity\PersonalData;
use App\Entity\User;
use App\Model\PersonalDataModel;
use Symfony\Component\Security\Core\User\UserInterface;

interface PersonalDataPersisterInterface
{
    public function save(PersonalDataModel $personalDataModel, UserInterface $user): void;

    public function update(PersonalDataModel $personalDataModel, PersonalData $personalData, UserInterface $user): void;

    public function remove(PersonalData $personalData): void;
}