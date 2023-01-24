<?php

class PdoProvider
{
    private static ?PDO $pdo = null;

    public static function get()
    {
        if (self::$pdo == null) { // Pokud jeste neexistuje, vyrob
            self::createMustacheInstance();
        }
        return self::$pdo;
    }

    private static function createMustacheInstance(): void
    {

        $host = AppConfig::get("database.host");
        $db = AppConfig::get("database.name");
        $user = AppConfig::get("database.user");
        $pass = AppConfig::get("database.password");
        $charset = AppConfig::get("database.charset");

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        self::$pdo = new PDO($dsn, $user, $pass, $options);
    }
}