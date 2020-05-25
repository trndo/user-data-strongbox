<?php


namespace App\Service\Encryptor;


use App\Service\Encryptor\DataEncryptor\DataEncryptorInterface;

class DataEncryptorHandler
{
    private DataEncryptorInterface $encryptor;

    public function __construct(DataEncryptorInterface $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    /**
     * @return DataEncryptorInterface
     */
    public function getEncryptor(): DataEncryptorInterface
    {
        return $this->encryptor;
    }

    /**
     * @param DataEncryptorInterface $encryptor
     * @return DataEncryptorHandler
     */
    public function setEncryptor(DataEncryptorInterface $encryptor): DataEncryptorHandler
    {
        $this->encryptor = $encryptor;
        return $this;
    }


}