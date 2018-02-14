<?php
namespace OC\BlogPost\Framework;

class Router 
{
	private $_request;
	private $_view;

	public function __construct(Request $request, View $view)
	{
		$this->_request = $request;
		$this->_view    = $view;
	}

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
	    		$_GET['id'] = $matches[3];
	    	}
	    }

	    $this->_request->setParameter(array_merge($_GET, $_POST));
	}

	public function createController() {
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
	        
	        return $controllerClassWithNamespace;
	    }
	    else {
	        throw new \Exception("Fichier '". $controllerFile. "' introuvable");
	    }
	}

	public function createAction() {
	    $action = 'index';
	    if ($this->_request->isParameter('action')) {
	        $action = $this->_request->getParameter('action');
	    }
	    return $action;
	}
}