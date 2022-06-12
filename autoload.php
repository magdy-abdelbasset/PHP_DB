<?php
require_once('./Src/Constance/config.php');
require_once('./Src/Constance/Sql.php');
require_once('./Src/handler/error.php');
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require $file;
                // echo $file;
                return true;

            }
            return false;
        });
    }
}
Autoloader::register();