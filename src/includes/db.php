<?php

class Database
{
    private static $connection;

    public static function connect()
    {
        return self::$connection = new PDO("mysql:host=localhost;dbname=user_db;", "root", "");
    }

    public static function disconnect()
    {
        return self::$connection = null;
    }
}
