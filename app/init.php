<?php declare(strict_types=1);

spl_autoload_register(function ($class) {
    require __DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});