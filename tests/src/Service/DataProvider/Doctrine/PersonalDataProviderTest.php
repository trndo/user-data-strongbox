<?php


namespace App\Tests\src\Service\DataProvider\Doctrine;

use App\Entity\PersonalData;
use App\Model\PersonalDataModel;
use App\Service\DataProvider\Doctrine\PersonalDataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersonalDataProviderTest extends KernelTestCase
{
    private $personalDataRepository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->personalDataRepository = $kernel->getContainer()
            ->get('doctrine')
            ->getRepository(PersonalData::class);
    }

    public function testGetPersonalDataModel(): void
    {
        $personalData = $this->personalDataRepository->find(10);
        $personalDataProvider = new PersonalDataProvider($this->personalDataRepository);

        $result = $personalDataProvider->getPersonalDataModel($personalData, 'qwerty12');

        $this->assertInstanceOf(PersonalDataModel::class, $result);
        $this->assertNull($result->userKey);
        $this->assertSame('CT449600', $result->passportCode);
        $this->assertSame('1234567890', $result->taxIdentificationNumber);
    }
}