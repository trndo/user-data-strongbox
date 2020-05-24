<?php


namespace App\Service\DataProvider;


use App\Entity\User;

interface PersonalDataProviderInterface
{
    public function getPersonalData(User $user): ?array;
}