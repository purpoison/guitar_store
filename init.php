<?php

spl_autoload_register(function ($className) {
    $filePath = CONTROLLERS_PATH . "/{$className}.php";
    if (is_readable($filePath)) {
        include_once $filePath;
    }
});

spl_autoload_register(function ($className) {
    $filePath = MODELS_PATH . "/{$className}.php";
    if (is_readable($filePath)) {
        include_once $filePath;
    }
});
