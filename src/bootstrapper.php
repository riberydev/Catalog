<?php
chdir(dirname(__DIR__));

ini_set('error_reporting', -1);
ini_set('display_errors', 'On');

date_default_timezone_set('America/Sao_Paulo');

define('PS', PATH_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(__DIR__) . DS);
define('LOG_PATH', ROOT_PATH . '..' . DS . 'log' . DS);
define('CONFIG_PATH', ROOT_PATH . 'Ribery' . DS . 'Config' . DS);


set_include_path(
    get_include_path() . PATH_SEPARATOR
    . ROOT_PATH . PATH_SEPARATOR
);

spl_autoload_register(
    function( $className ) {

        $classPath = str_replace( '\\', DIRECTORY_SEPARATOR, sprintf( '%s', $className ) ) . '.php';

        if ( stream_resolve_include_path( $classPath ) !== false ) {
            require_once $classPath;
        }
    }
);


require ROOT_PATH . '/../vendor/autoload.php';