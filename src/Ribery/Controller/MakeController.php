<?php
namespace Ribery\Controller;

use \Exception;
use \Respect\Rest\Routable;
use \Ribery\Service\MakeService;
use \Symfony\Component\HttpFoundation\JsonResponse;

class MakeController implements Routable
{
    private $database;

    public function get($id = null)
    {
        try
        {
            $service = new MakeService();
            $makes = $service->getAll();

            $response = new JsonResponse($makes);
            $response->send();

        } catch (Exception $e) {

            //TODO: BaseController with abstract methods to handle errors response
            //TODO: Log exceptions to beautify API error response
            $response = new JsonResponse();
            $response->setStatusCode(500);
            $response->setData(['error' => true, 'message' => $e->getMessage(), 'code' => $e->getCode()]);
            $response->send();
        }
    }
    
    public function delete($id)
    {

    }
    
    public function put($id)
    {

    }
}