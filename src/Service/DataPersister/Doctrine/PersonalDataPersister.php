<?php


namespace App\Service\DataPersister\Doctrine;

use App\DataMapper\PersonalDataMapper;
use App\Entity\PersonalData;
use App\Entity\User;
use App\Model\PersonalDataModel;
use App\Service\DataPersister\PersonalDataPersisterInterface;
use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\DataEncryptorHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function save(PersonalDataModel $personalDataModel, UserInterface $user): void
    {
        $personalData = new PersonalData();
        $encryptedModel = $this->encryptData($personalDataModel);
        $personalData = PersonalDataMapper::fromModelToEntity($encryptedModel, $personalData);
        //dd($personalData);
        $personalData->setUser($user);

        $this->entityManager->persist($personalData);
        $this->entityManager->flush();
    }

    public function update(
        PersonalDataModel $personalDataModel,
        PersonalData $personalData,
        UserInterface $user
    ): void {
        $encryptedModel = $this->encryptData($personalDataModel);
        $personalData = PersonalDataMapper::fromModelToEntity($encryptedModel, $personalData);
        $personalData->setUser($user);

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
        $userKey = $personalDataModel->userKey;
        $data = (array) $personalDataModel;

        foreach ($data as $key => $value) {
            $personalDataModel->$key = $encryptor->encrypt($value, $userKey);
        }

        return $personalDataModel;
    }
}