<?php

namespace Charczuk\Library\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApplicationController extends Controller
{
    public $request = null;
    /**
     * Shortcut to return the request service.
     *
     * @return Request
     */
    public function getRequest()
    {
        if (!$this->request) {
            $this->request = parent::getRequest();
            if (0 === strpos($this->request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($this->request->getContent(), true);
                $this->request->request->replace(is_array($data) ? $data : array());
            }
        }

        return $this->request;
    }

    public function hasParams(array $arrParam, string $method = null)
    {
        foreach ($arrParam as $param) {
            if((($method === null || strtolower($method) === 'post') && !in_array($param, $this->getRequest()->request->keys()))
                && (($method === null || strtolower($method) === 'get') && !in_array($param, $this->getRequest()->query->keys()))) {
                return false;
            }
        }

        return true;
    }

}
