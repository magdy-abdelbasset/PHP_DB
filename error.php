<?php
require_once('./handler-web.php');
if (defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'DEVELOPMENT':
            // $base_url = 'http://localhost/product/';
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL|E_STRICT);
            set_error_handler ("ERR_HANDLER", E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
            register_shutdown_function("shutdownFunction");
            set_exception_handler("EXC_HANDLER");
            break;

        case 'PRODUCTION':
            // $base_url = 'Production URL'; /* https://google.com */
            error_reporting(0);
            /* Mechanism to log errors */
            break;

        default:
            exit('The application environment is not set correctly.');
    }
    
}