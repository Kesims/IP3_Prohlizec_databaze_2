<?php

require_once __DIR__ . "/vendor/autoload.php";

spl_autoload_register(
    function ($class_name) {
        $filename = __DIR__ . "/models/{$class_name}.php";
        if(file_exists($filename)) {};
        include __DIR__ . "/classes/{$class_name}.php";
    }
);

spl_autoload_register(
    function ($class_name) {
        include __DIR__ . "/models/{$class_name}.php";
    }
);


use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT);


