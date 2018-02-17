<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class App
{
    /**
     * @var Container
     */
    private $_container;

    public function __construct()
    {
        $this->init();
        $this->run();
    }

    private function init()
    {
        $this->_container = Container::getInstance();
    }

    private function run()
    {
        try {
            $router = $this->_container->getRouter()->routeRequest(); 
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    private function error($errorMessage)
    {
        $this->_container->getView()->generate(['errorMessage' => $errorMessage]);
    }
}