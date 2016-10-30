<?php
namespace Ribery\Controller;

use \Exception;
use \Respect\Rest\Routable;


class IndexController extends BaseController implements Routable
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {        
        $this->ok('');
        $this->response->send();
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