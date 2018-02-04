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
		try {
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
		catch(\Exception $e) {
			$this->error($e->getMessage());
		}
	}

	public function error($errorMessage)
	{
		$this->_view->generate(['errorMessage' => $errorMessage]);
	}
}