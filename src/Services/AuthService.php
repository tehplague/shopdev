<?php

namespace Jtl\Shop4\Services;

class AuthService
{
    public static function encryptUserPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyUserPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
