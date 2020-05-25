<?php


namespace App\Service\Encryptor\Exception;


use Throwable;

class HashException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->message = 'Internal error: hash_hmac() failed';
    }
}