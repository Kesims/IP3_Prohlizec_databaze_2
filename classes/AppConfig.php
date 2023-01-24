<?php

use Noodlehaus\Config;

class AppConfig
{
    private static ?Config $config = null;

    public static function get(string $key)
    {
        if (self::$config == null)
            self::createConfigInstance();

        return self::$config->get($key);
    }


    private static function createConfigInstance() :void {
        self::$config = Config::load(["../config/config.json", "../config/config_local.json"]);
    }
}