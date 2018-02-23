<?php
namespace OC\BlogPost\Service;
session_start();

use OC\BlogPost\Framework\Container;

class Token 
{
    /**
     * 
     * @var Request
     * @access private
     */
    private $_request;


    /**
     * @access public
     * @return void
     */

    public function __construct()
    {
        $container = Container::getInstance();
        $this->_request = $container->getRequest();
    }


    /**
     * @access public
     * @return string
     */

    public function createToken()
    {
        $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $_SESSION['token'] = $token;
        return $token;
    }


    /**
     * @access public
     * @return void
     */

    public function checkToken()
    {
        $token = $this->_request->getParameter("token");
        if ( ! isset($_SESSION['token']) || empty($_SESSION['token']) || ($_SESSION['token'] != $token)) {
            throw new \Exception('Erreur de vérification.');
        }
    }
}