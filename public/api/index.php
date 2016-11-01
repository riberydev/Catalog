<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src/bootstrapper.php';

use \Exception;

try
{
    Ribery\Application::start();
} catch(Exception $e) {
    echo $e->getMessage();
}