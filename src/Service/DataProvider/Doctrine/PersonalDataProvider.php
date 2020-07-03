<?php


namespace App\Service\DataProvider\Doctrine;


use App\DataMapper\PersonalDataMapper;
use App\Entity\PersonalData;
use App\Entity\User;
use App\Model\PersonalDataModel;
use App\Repository\PersonalDataRepository;
use App\Service\DataProvider\PersonalDataProviderInterface;
use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\DataEncryptorHandler;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function getPersonalData(UserInterface $user): ?array
    {
        return $this->personalDataRepository->findAllByUser($user);

//        $string = stream_get_contents($data[0]->getPassportCode());
//        $aes = new AES256();
//        dd($aes->decrypt($string, 123456));
    }

    public function getPersonalDataModel(PersonalData $personalData, string $userKey): PersonalDataModel
    {
        $encryptorHandler = new DataEncryptorHandler(new AES256());
        $encryptor = $encryptorHandler->getEncryptor();

        $personalDataModel = PersonalDataMapper::fromEntityToModel($personalData);
        $data = (array) $personalDataModel;
        unset($data['userKey']);

        foreach ($data as $key => $value) {
            $personalDataModel->$key = $encryptor->decrypt($value, $userKey);
        }

        return $personalDataModel;
    }
}