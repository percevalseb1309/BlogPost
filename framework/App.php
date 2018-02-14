<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class App
{
    /**
     * @var Container
     */
    private $container;

    public function __construct()
    {
        $this->init();
        $this->run();
    }

    private function init()
    {
        $this->container = new Container();
    }

    private function run()
    {
        try {
            $router = $this->container->getRouter(); 
            $router->routeRequest(); 
            $controllerClass = $router->createController(); 
            $controller = $this->container->getController($controllerClass);
            $action = $router->createAction();
            $controller->executeAction($action);
        }  
        catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function error($errorMessage)
    {
        $this->container->getView()->generate(['errorMessage' => $errorMessage]);
    }
}