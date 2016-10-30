<?php
namespace Ribery\Controller;

use \Exception;
use \InvalidArgumentException;
use \Respect\Rest\Routable;
use \Ribery\Service\MakeService;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class MakeController extends BaseController implements Routable
{
    private $database;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        try
        {
            $service = new MakeService();

            $this->ok($service->getAll());

        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        $this->response->send();

        return;
    }

    public function post()
    {
        try
        {
            $name = filter_var($this->request->request->get('name', ''), FILTER_SANITIZE_SPECIAL_CHARS);
            $desc = filter_var($this->request->request->get('description', ''), FILTER_SANITIZE_SPECIAL_CHARS);
            $website = filter_var($this->request->request->get('website', ''), FILTER_SANITIZE_SPECIAL_CHARS);
            $image = filter_var($this->request->request->get('image', ''), FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($name))
                throw new InvalidArgumentException('Name is invalid.');

            if (empty($desc))
                throw new InvalidArgumentException('Description is invalid.');

            $makeModel = new Make($name, $desc, $website, $image);
            $service = new MakeService();
            $makeModel = $service->create($make);

            if (!empty($makeModel->getId())) {
                $this->buildResponse($make, 'Created', Response::HTTP_CREATED);
                
                $this->response->send();
            }

        } catch (InvalidArgumentException $e) {
            $this->error($e->getMessage(), $e->getCode());

        } catch (Exception $e) {
            $this->error($e->getMessage(), $e->getCode());
        }

        $this->response->send();

        return;
    }
    
    public function delete($id)
    {

    }
    
    public function put($id)
    {

    }
}