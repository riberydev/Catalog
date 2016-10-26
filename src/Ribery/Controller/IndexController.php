<?php
namespace Ribery\Controller;

use \Exception;
use \Respect\Rest\Routable;


class IndexController implements Routable
{
    public function __construct()
    {
    }

    public function get()
    {        
        echo 'Hello';
    }
    
    public function delete()
    {
        throw new Exception('Not implemented yet');
    }
    
    public function put()
    {
        throw new Exception('Not implemented yet');
    }
}