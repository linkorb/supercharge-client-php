<?php

namespace Supercharge\Client;

class Supercharge
{
    public static $username;

    public static $password;

    // @var string The base URL for the SuperCharge API with administrationCode and accountCode.
    public static $apiBase;

    /**
     * @return string
     */
    public static function getUsername()
    {
        return self::$username;
    }

    /**
     * @param string $user
     */
    public static function setUsername($username)
    {
        self::$username = $username;
    }

    /**
     * @return string
     */
    public static function getPassword()
    {
        return self::$password;
    }

    /**
     * @param string $password
     */
    public static function setPassword($password)
    {
        self::$password = $password;
    }

    /**
     * @return string
     */
    public static function getApiBase()
    {
        return self::$apiBase;
    }

    /**
     * @param string $apiBase
     */
    public static function setApiBase($apiBase)
    {
        self::$apiBase = $apiBase;
    }
}
