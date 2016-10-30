<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src/bootstrapper.php';

use \Respect\Rest\Router;
use \Exception;

try
{
    //TODO: Implement a Front Controller

    $r3 = new Router('/catalog/api');
    $r3->get('/', 'Ribery\Controller\IndexController');
    $r3->any('/makes', 'Ribery\Controller\MakeController');
    
} catch(Exception $e) {

}