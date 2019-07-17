<?php
define('HWPUSH_ROOT', dirname(__DIR__) . '/');

function hwpushAutoload(string $class)
{
    $parts = explode('\\', $class);
    $path = HWPUSH_ROOT . implode('/', $parts) . '.php';
    if (file_exists($path)) {
        include_once($path);
    }
}

spl_autoload_register('hwpushAutoload');
