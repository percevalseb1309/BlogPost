<?php
namespace OC\BlogPost\Framework;
session_start();

abstract class Controller 
{
    private $_twig;
    private $_action;
    protected $_request;
    private $_view;

    public function __construct(\Twig_Environment $twig, View $view)
    {
        $this->_twig = $twig;
        $this->_view = $view;
    }

    public function setRequest(Request $request)
    {
        $this->_request = $request;
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

    protected function createToken()
    {
        $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $_SESSION['token'] = $token;
        return $token;
    }

    protected function checkToken()
    {
        $token = $this->_request->getParameter("token");
        if ( ! isset($_SESSION['token']) || empty($_SESSION['token']) || ($_SESSION['token'] != $token)) {
            throw new \Exception('Erreur de vérification.');
        }
    }
}