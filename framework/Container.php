<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Router;
use OC\BlogPost\Framework\Request;
use OC\BlogPost\Framework\View;
use OC\BlogPost\Framework\Loader;

class Container
{
    protected static $instance;
    private $_router;
    private $_request;
    private $_view;
    private $_twig;
    private $_controller;
    private $_loader;
    private $_service;
    private $_model;

    protected function __construct() { } 

    public static function getInstance() {
        if ( ! SELF::$instance) {
            SELF::$instance = new SELF();
        }
        return SELF::$instance;
    } 

    /**
     * @return Router
     */
    public function getRouter()
    {
        if ($this->_router === null) {
            $this->_router = new Router($this->getRequest(), $this->getView());
        }
        return $this->_router;
    }

    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = new Request();
        }
        return $this->_request;
    }    

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = new View($this->getTwig());
        }
        return $this->_view;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        if ($this->_twig === null) {
            $loader = new \Twig_Loader_Filesystem(__DIR__.'/../view');
            $this->_twig = new \Twig_Environment($loader, array(
                'cache' => false
            ));
        }
        return $this->_twig;
    }

    public function getController($controller)
    {
        if ($this->_controller === null) {
            $this->_controller = new $controller($this->getLoader());
            $this->_controller->setRequest($this->getRequest());
            $this->_controller->setView($this->getView());
        }
        return $this->_controller;
    }

    public function getLoader()
    {
        if ($this->_loader === null) {
            $this->_loader = new Loader;
        }
        return $this->_loader;
    }

    public function getService($index, $service)
    {
        if ($this->_service === null || ! (isset($this->_service[$index]) && empty($this->_service[$index]))) {
            $this->_service[$index] = new $service;
        }
        return $this->_service[$index];
    }    

    public function getModel($index, $model)
    {
        if ($this->_model === null || ! (isset($this->_model[$index]) && empty($this->_model[$index]))) {
            $this->_model[$index] = new $model;
        }
        return $this->_model[$index];
    }
}