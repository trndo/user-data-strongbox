<?php


namespace App\Service\DataProvider\Doctrine;


use App\Entity\User;
use App\Repository\PersonalDataRepository;
use App\Service\DataProvider\PersonalDataProviderInterface;

class PersonalDataProvider implements PersonalDataProviderInterface
{
    /**
     * @var PersonalDataRepository
     */
    private PersonalDataRepository $personalDataRepository;

    public function __construct(PersonalDataRepository $personalDataRepository)
    {
        $this->personalDataRepository = $personalDataRepository;
    }

    public function getPersonalData(User $user): ?array
    {
        // TODO: Implement getPersonalData() method.
    }
}