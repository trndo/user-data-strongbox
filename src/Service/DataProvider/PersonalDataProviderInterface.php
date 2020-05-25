<?php


namespace App\Service\DataProvider;


use App\Entity\PersonalData;
use App\Model\PersonalDataModel;
use Symfony\Component\Security\Core\User\UserInterface;

interface PersonalDataProviderInterface
{
    public function getPersonalData(UserInterface $user): ?array;

    public function getPersonalDataModel(PersonalData $personalData, string $userKey): PersonalDataModel;

}