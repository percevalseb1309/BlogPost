<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class Router 
{
	/**
	 * 
	 * @var Container
	 * @access private
	 */
	private $_container;

	/**
	 * 
	 * @var Request
	 * @access private
	 */
	private $_request;

	/**
	 * @access public
	 * @param Request $request 
	 * @param View $view 
	 * @return void
	 */

	public function __construct(Request $request)
	{
		$this->_container = Container::getInstance();
		$this->_request   = $request;
	}


	/**
	 * @access public
	 * @return void
	 */

	public function routeRequest()
	{
		$path = preg_replace('#(.+)index.php(.+)#i', 'index.php$2', $_SERVER['REQUEST_URI']);
     	preg_match('#^index.php?/(\w+)/?(\w+)?/?(\d+)?#i', $path, $matches);
	    if ( ! empty($matches) && isset($matches[1])) { 
	    	$_GET['controller'] = $matches[1];
	    	if (isset($matches[2])) {
	    		$_GET['action'] = $matches[2];
	    	}		    	
	    	if (isset($matches[3])) {
	    		$_GET['id'] = (int) $matches[3];
	    	}
	    }

	    $this->_request->setParameter(array_merge($_GET, $_POST));

	    $controller = $this->createController(); 
	    $action = $this->createAction();
	    $controller->executeAction($action);
	}


	/**
	 * @access private
	 * @return Controller
	 */

	private function createController() {
	    $controller = DEFAULT_CONTROLLER;
	    if ($this->_request->isParameter('controller')) {
	        $controller = $this->_request->getParameter('controller');
	        $controller = ucfirst(strtolower($controller));
	    }

	    $controllerClass = $controller. "Controller";
	    $controllerFile = "controller/" . $controllerClass . ".php";
	    $controllerClassWithNamespace = "\OC\BlogPost\Controller\\" .$controllerClass;
	    if (file_exists($controllerFile)) {
	        require_once($controllerFile);
	        $controller = $this->_container->getController($controllerClassWithNamespace);
	        return $controller;
	    }
	    else {
	        throw new \Exception("Fichier '". $controllerFile. "' introuvable");
	    }
	}


	/**
	 * @access private
	 * @return string
	 */

	private function createAction() {
	    $action = 'index';
	    if ($this->_request->isParameter('action')) {
	        $action = $this->_request->getParameter('action');
	    }
	    return $action;
	}
}