<?php


namespace App\Service\DataPersister\Doctrine;


use App\DataMapper\PersonalDataMapper;
use App\Entity\PersonalData;
use App\Model\PersonalDataModel;
use App\Service\DataPersister\PersonalDataPersisterInterface;
use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\DataEncryptorHandler;
use Doctrine\ORM\EntityManagerInterface;

class PersonalDataPersister implements PersonalDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    private $personalDataRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->personalDataRepository = $this->entityManager->getRepository(
            PersonalData::class
        );
    }

    public function save(PersonalDataModel $personalDataModel): void
    {
        $personalData = new PersonalData();
        $encryptedModel = $this->encryptData($personalDataModel);
        $personalData = PersonalDataMapper::fromModelToEntity($encryptedModel, $personalData);

        $this->entityManager->persist($personalData);
        $this->entityManager->flush();
    }

    public function update(PersonalDataModel $personalDataModel, PersonalData $personalData): void
    {
        $encryptedModel = $this->encryptData($personalDataModel);
        PersonalDataMapper::fromModelToEntity($encryptedModel, $personalData);

        $this->entityManager->flush();
    }

    public function remove(PersonalData $personalData): void
    {
        $this->entityManager->remove($personalData);
        $this->entityManager->flush();
    }

    private function encryptData(PersonalDataModel $personalDataModel): PersonalDataModel
    {
        $encryptorHandler = new DataEncryptorHandler(new AES256());
        $encryptor = $encryptorHandler->getEncryptor();
        $data = PersonalDataMapper::fromModelToArray($personalDataModel);

        foreach ($data as $key => $value) {
            $data[$key] = $encryptor->encrypt($value, 'testKeyForUser');
        }

        return new PersonalDataModel();
    }
}