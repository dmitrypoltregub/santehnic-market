<?php
spl_autoload_register(function ($className) {
    $path .= str_replace('\\', '/', substr($className, $length)) . '.php';
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/classes/' . $path)) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/classes/' . $path;
    }
});
