<?php


namespace App\Tests\src\Service\DataPersister\Doctrine;


use App\Entity\PersonalData;
use App\Entity\User;
use App\Model\PersonalDataModel;
use App\Service\DataPersister\Doctrine\PersonalDataPersister;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class PersonalDataPersisterTest extends TestCase
{
    public function testSave(): void
    {
        $emStub = $this->createMock(EntityManagerInterface::class);
        $user = new User();

        $emStub->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(PersonalData::class));

        $emStub->expects($this->once())
            ->method('flush');

        $creditCardDataPersister = new PersonalDataPersister($emStub);
        $creditCardDataPersister->save($this->getPersonalDataModel(), $user);
    }

    private function getPersonalDataModel(): PersonalDataModel
    {
        $personalDataModel = new PersonalDataModel();
        $personalDataModel->userKey = '1234567';
        $personalDataModel->passportCode = 'CT89675';
        $personalDataModel->taxIdentificationNumber = '5678912435';

        return $personalDataModel;
    }
}