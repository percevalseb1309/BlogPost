<?php
namespace OC\BlogPost\Framework;

abstract class Controller 
{
    /**
     * 
     * @var Request
     * @access protected
     */
    protected $_request;

    /**
     * 
     * @var View
     * @access private
     */
    private $_view;

    /**
     * 
     * @var string
     * @access private
     */
    private $_action;


    /**
     * @access public
     * @param Request $request 
     * @return void
     */

    public function setRequest(Request $request)
    {
        $this->_request = $request;
    }  


    /**
     * @access public
     * @param View $view 
     * @return void
     */  

    public function setView(View $view)
    {
        $this->_view = $view;
    } 


    /**
     * @access public
     * @param string $action 
     * @return void
     */   

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


    /**
     * @access public
     * @return void
     */

    public abstract function index();


    /**
     * @access public
     * @param string $view 
     * @param array $data 
     * @return void
     */

    protected function generateView($view, array $data = array())
    {
        $this->_view->setView($view);
        $this->_view->generate($data);
    }
}