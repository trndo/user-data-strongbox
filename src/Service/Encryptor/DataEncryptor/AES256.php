<?php


namespace App\Service\Encryptor\DataEncryptor;


use App\Service\Encryptor\Exception\DecryptorException;
use App\Service\Encryptor\Exception\EncryptorException;
use App\Service\Encryptor\Exception\HashException;
use App\Service\Encryptor\Exception\HashUnequalException;

class AES256 implements DataEncryptorInterface
{
    private const ENCRYPTION_METHOD = "AES-256-CBC";
    private const HASHING_ALGORITHM = "SHA256";
    private const INITIALIZATION_VECTOR_LENGTH = 16;

    /**
     * Encrypt data using OpenSSL (AES-256-CBC)
     *
     * @param string $plainText Data to be encrypted
     * @param string $cryptoKey Key for encryption
     * @return string Raw binary string (Initialization Vector + Hash + Encrypted Data).
     * The first 16 bytes is IV next 32 bytes is HMAC-SHA256 and the rest is encrypted data
     *
     * @throws \Exception
     */
    public function encrypt(string $plainText, string $cryptoKey): string
    {
        $key = hash(self::HASHING_ALGORITHM, $cryptoKey, true);
        $initializationVector = openssl_random_pseudo_bytes(16);

        $encryptedData = openssl_encrypt(
            $plainText,
            self::ENCRYPTION_METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $initializationVector
        );

        if (!$encryptedData) {
            throw new EncryptorException("Internal error: openssl_encrypt() failed:"
                . openssl_error_string());
        }

        $hash = hash_hmac(
            self::HASHING_ALGORITHM,
            $encryptedData . $initializationVector,
            $key,
            true
        );

        if (!$hash) {
            throw new HashException();
        }

        return $initializationVector . $hash . $encryptedData;
    }

    /**
     * Decrypt data using OpenSSL (AES-256-CBC)
     *
     * @param string $encryptedText Encrypted data - Raw binary string
     * (Initialization Vector + Hash + Encrypted Data).
     * @param string $cryptoKey Key for decryption
     * @return string Decrypted data
     *
     * @throws \Exception
     */
    public function decrypt(string $encryptedText, string $cryptoKey): string
    {
        $key = hash(self::HASHING_ALGORITHM, $cryptoKey, true);

        $initializationVector = $this->getInitializationVector($encryptedText);
        $hash = $this->getHash($encryptedText);
        $encryptedData = $this->getEncryptedData($encryptedText);

        $generatedHash = hash_hmac(
            self::HASHING_ALGORITHM,
            $encryptedData . $initializationVector,
            $key,
            true
        );

        if (!hash_equals($generatedHash, $hash)) {
            throw new HashUnequalException();
        }

        $decryptedData = openssl_decrypt(
            $encryptedData,
            self::ENCRYPTION_METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $initializationVector
        );

        if (!$decryptedData)
        {
            throw new DecryptorException("Internal error: openssl_decrypt() failed:"
                . openssl_error_string());
        }

        return $decryptedData;
    }

    private function getInitializationVector(string $encryptedText): string
    {
        return substr($encryptedText, 0, 16);
    }

    private function getHash(string $encryptedText): string
    {
        return substr($encryptedText, 16, 32);
    }

    private function getEncryptedData(string $encryptedText): string
    {
        return substr($encryptedText, 48);
    }
}