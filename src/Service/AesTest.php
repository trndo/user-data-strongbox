<?php


namespace App\Service;


class AesTest
{
    /**
     * Encrypt data using OpenSSL (AES-256-CBC)
     * @param string $plaindata Data to be encrypted
     * @param string $cryptokey key for encryption (with 256 bit of entropy)
     * @param string $hashkey key for hashing (with 256 bit of entropy)
     * @return string IV+Hash+Encrypted as raw binary string. The first 16
     *     bytes is IV, next 32 bytes is HMAC-SHA256 and the rest is
     *     $plaindata as encrypted.
     * @throws \Exception on internal error
     */
    public static function encrypt($plaindata, $cryptokey)
    {
        $method = "AES-256-CBC";
        $key = hash('sha256', $cryptokey, true);
        $iv = openssl_random_pseudo_bytes(16);

        $cipherData = openssl_encrypt($plaindata, $method, $key, OPENSSL_RAW_DATA, $iv);

        if ($cipherData === false)
        {
            throw new \Exception("Internal error: openssl_encrypt() failed:".openssl_error_string());
        }

        $hash = hash_hmac('sha256', $cipherData.$iv, $key, true);

        if ($hash === false)
        {
            throw new \Exception("Internal error: hash_hmac() failed");
        }

        return $iv.$hash.$cipherData;
    }

    /**
     * Decrypt data using OpenSSL (AES-256-CBC)
     * @param string $encrypteddata IV+Hash+Encrypted as raw binary string
     *     where the first 16 bytes is IV, next 32 bytes is HMAC-SHA256 and
     *     the rest is encrypted payload.
     * @param string $cryptokey key for decryption (with 256 bit of entropy)
     * @param string $hashkey key for hashing (with 256 bit of entropy)
     * @return string Decrypted data
     * @throws \Exception on internal error
     *
     * Based on code from: https://stackoverflow.com/a/46872528
     */
    public  function decrypt($encrypteddata, $cryptokey)
    {
        $method = "AES-256-CBC";
        $key = hash('sha256', $cryptokey, true);
        $iv = substr($encrypteddata, 0, 16);
        $hash = substr($encrypteddata, 16, 32);
        $cipherdata = substr($encrypteddata, 48);

        if (!hash_equals(hash_hmac('sha256', $cipherdata.$iv, $key, true), $hash))
        {
            throw new \Exception("Internal error: Hash verification failed");
        }

        $plaindata = openssl_decrypt($cipherdata, $method, $key, OPENSSL_RAW_DATA, $iv);

        if ($plaindata === false)
        {
            throw new \Exception("Internal error: openssl_decrypt() failed:".openssl_error_string());
        }

        return $plaindata;
    }
}
