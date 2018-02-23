<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Router;
use OC\BlogPost\Framework\Request;
use OC\BlogPost\Framework\View;
use OC\BlogPost\Framework\Loader;

class Container
{
    /**
     * 
     * @var Container
     * @access private
     */
    private static $_instance;

    /**
     * 
     * @var Router
     * @access private
     */
    private $_router;

    /**
     * 
     * @var Request
     * @access private
     */
    private $_request;

    /**
     * 
     * @var View
     * @access private
     */
    private $_view;

    /**
     * 
     * @var Twig_Environment
     * @access private
     */
    private $_twig;

    /**
     * 
     * @var Controller
     * @access private
     */
    private $_controller;

    /**
     * 
     * @var Loader
     * @access private
     */
    private $_loader;

    /**
     * 
     * @var array
     * @access private
     */
    private $_service;

    /**
     * 
     * @var array
     * @access private
     */
    private $_model;


    /**
     * @access private
     * @return void
     */

    private function __construct() { } 


    /**
     * @access public
     * @return Container
     */

    public static function getInstance() {
        if ( ! SELF::$_instance) {
            SELF::$_instance = new SELF();
        }
        return SELF::$_instance;
    } 


    /**
     * @access public
     * @return Router
     */

    public function getRouter()
    {
        if ($this->_router === null) {
            $this->_router = new Router($this->getRequest());
        }
        return $this->_router;
    }


    /**
     * @access public
     * @return Request
     */

    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = new Request();
        }
        return $this->_request;
    } 


    /**
     * @access public
     * @return View
     */   

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = new View($this->getTwig());
        }
        return $this->_view;
    }


    /**
     * @access public
     * @return Twig_Environment
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


    /**
     * @access public
     * @return Controller
     */

    public function getController($controller)
    {
        if ($this->_controller === null) {
            $this->_controller = new $controller($this->getLoader());
            $this->_controller->setRequest($this->getRequest());
            $this->_controller->setView($this->getView());
        }
        return $this->_controller;
    }


    /**
     * @access public
     * @return Loader
     */

    public function getLoader()
    {
        if ($this->_loader === null) {
            $this->_loader = new Loader;
        }
        return $this->_loader;
    }


    /**
     * @access public
     * @return Email|token
     */

    public function getService($index, $service)
    {
        if ($this->_service === null || ! (isset($this->_service[$index]) && empty($this->_service[$index]))) {
            $this->_service[$index] = new $service;
        }
        return $this->_service[$index];
    } 


    /**
     * @access public
     * @return PostManager|CommentManger
     */   

    public function getModel($index, $model)
    {
        if ($this->_model === null || ! (isset($this->_model[$index]) && empty($this->_model[$index]))) {
            $this->_model[$index] = new $model;
        }
        return $this->_model[$index];
    }
}