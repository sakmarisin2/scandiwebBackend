<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $baseDir = __DIR__ . '/src/';
            $relativePath = str_replace('\\', '/', $class) . '.php';
            $file = $baseDir . $relativePath;
        
            if (file_exists($file)) {
                require $file;
                return;
            }
            
            http_response_code(500);
            throw new Exception("File for class $class not found");
        });
    }
}