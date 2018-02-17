<?php
namespace OC\BlogPost\Framework;

abstract class Controller 
{
    protected $_request;
    private $_view;
    private $_action;

    public function setRequest(Request $request)
    {
        $this->_request = $request;
    }    

    public function setView(View $view)
    {
        $this->_view = $view;
    }    

    public function executeAction($action)
    {
        if (method_exists($this, $action)) {
            $this->_action = $action;
            $this->{$this->_action}();
        }
        else {
            $controllerClass = get_class($this);
            throw new \Exception("Action '". $action. "' non définie dans la classe '" .$controllerClass. "'");
        }
    }

    public abstract function index();

    protected function generateView($view, array $data = array())
    {
        $this->_view->setView($view);
        $this->_view->generate($data);
    }
}