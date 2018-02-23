<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class App
{
    /**
     * 
     * @var Container
     * @access private
     */
    private $_container;


    /**
     * @access public
     * @return void
     */

    public function __construct()
    {
        $this->init();
        $this->run();
    }


    /**
     * @access private
     * @return void
     */

    private function init()
    {
        $this->_container = Container::getInstance();
    }


    /**
     * @access private
     * @return void
     */

    private function run()
    {
        try {
            $router = $this->_container->getRouter()->routeRequest(); 
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }


    /**
     * @access private
     * @param string $errorMessage 
     * @return void
     */

    private function error($errorMessage)
    {
        $this->_container->getView()->generate(['errorMessage' => $errorMessage]);
    }
}