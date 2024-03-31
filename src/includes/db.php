<?php

class Database
{
    private static $connection;

    public static function connect()
    {
        return self::$connection = new PDO("mysql:host=localhost;dbname=futu;", "root", "");
    }

    public static function disconnect()
    {
        return self::$connection = null;
    }
}
