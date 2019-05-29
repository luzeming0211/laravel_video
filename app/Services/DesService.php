<?php

namespace App\Services;


class DesService
{

    public static function des_ecb_encrypt($data, $key)
    {
        return openssl_encrypt ($data, 'des-ecb', $key);
    }

    public static function des_ecb_decrypt ($data, $key)
    {
        return openssl_decrypt($data, 'des-ecb', $key);
    }

}