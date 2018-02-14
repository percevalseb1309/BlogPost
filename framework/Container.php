<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Router;
use OC\BlogPost\Framework\Request;
use OC\BlogPost\Framework\View;

class Container
{
    private $_router;
    private $_request;
    private $_view;
    private $_twig;
    private $_controller;

    /**
     * @return Router
     */
    public function getRouter()
    {
        if ($this->_router === null) {
            $this->_router = new Router($this->getRequest(), $this->getView());
        }
        return $this->_router;
    }

    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = new Request();
        }
        return $this->_request;
    }    

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = new View($this->getTwig());
        }
        return $this->_view;
    }

    /**
     * @return \Twig_Environment
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

    public function getController($controller)
    {
        if ($this->_controller === null) {
            $this->_controller = new $controller();
            $this->_controller->setRequest($this->getRequest());
            $this->_controller->setView($this->getView());
        }
        return $this->_controller;
    }

    /*public function getPostManager()
    {
        if ($this->_postManager === null) {
            $this->_postManager = new PostManager();
        }
        return $this->_postManager;
    }

    public function getCommentManager()
    {
        if ($this->_commentManager === null) {
            $this->_commentManager = new CommentManager();
        }
        return $this->_commentManager;
    }

    public function getMailer()
    {
        if ($this->_mailer === null) {
            $this->_mailer = new Email();
        }
        return $this->_mailer;
    }*/
}