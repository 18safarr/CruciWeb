<?php

namespace app;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        // Retirer le namespace 'app\' du nom de la classe
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        
        // Construire le chemin du fichier correspondant
        $file = __DIR__ . '/' . $class . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        } else {
            die("Fichier introuvable : $file");
        }
    }
}
