<?php

// Singleton pro instanci mustache, statickej, kterej se může odkudkoliv použít

class MustacheProvider
{
    private static ?Mustache_Engine $mustacheEngine = null;

    public static function get()
    {
        if (self::$mustacheEngine == null) { // Pokud jeste neexistuje, vyrob
            self::createMustacheInstance();
        }
        return self::$mustacheEngine;
    }

    private static function createMustacheInstance(): void
    {
        self::$mustacheEngine = new Mustache_Engine([
            'entity_flags' => ENT_QUOTES,
            'loader' => new Mustache_Loader_FilesystemLoader(__DIR__ . "/../templates/")
        ]);
    }
}