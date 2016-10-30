<?php
namespace Ribery\Controller;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\JsonResponse;

class BaseController
{
    protected $request;
    protected $response;

    protected function __construct()
    {
        $this->request = new Request($_GET, $_POST, $_SERVER, $_FILES, array());
        $this->response = new JsonResponse();
    }

    protected function buildResponse($data = array(), $desc = 'Ok', $statusCode = Response::HTTP_OK)
    {
        $statusCode = ((int)$statusCode ?: Response::HTTP_OK);
        $this->response->setStatusCode($statusCode);
        $this->response->setData(['data' => $data, 'message' => $desc, 'code' => $statusCode]);
    }

    protected function badRequest()
    {
        $this->error('Bad Request', Response::HTTP_BAD_REQUEST);
    }

    protected function forbidden()
    {
        $this->error('Forbidden', Response::HTTP_FORBIDDEN);
    }

    protected function unauthorized()
    {
        $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    protected function ok($data = array())
    {
        $this->buildResponse($data, 'Ok', Response::HTTP_OK);
    }

    protected function error($desc = 'Internal Server Error', $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        $statusCode = ((int)$statusCode ? $statusCode : Response::HTTP_OK);
        $this->response->setStatusCode($statusCode);
        $this->response->setData(['error' => true, 'message' => $desc, 'code' => $statusCode]);
    }
}