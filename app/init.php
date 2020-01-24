<?php declare(strict_types=1);

spl_autoload_register(function ($class) {
    $classPath = __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    require $classPath;
});