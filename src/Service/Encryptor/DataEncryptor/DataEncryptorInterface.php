<?php


namespace App\Service\Encryptor\DataEncryptor;


interface DataEncryptorInterface
{
    /**
     * Return encrypted string from plain text
     *
     * @param string $plainText
     * @param string $cryptoKey
     * @return string
     */
    public function encrypt(string $plainText, string $cryptoKey): string;

    /**
     * Return decrypted text from encrypted string
     *
     * @param string $encryptedText
     * @param string $cryptoKey
     * @return string
     */
    public function decrypt(string $encryptedText, string $cryptoKey): string;
}