<?php
namespace OC\BlogPost\Controller;

use \OC\BlogPost\Framework\Controller;
use \OC\BlogPost\Framework\Loader;

class HomeController extends Controller
{
    /**
     * 
     * @var Token
     * @access private
     */
    private $_token;

    /**
     * 
     * @var Mailer
     * @access private
     */
    private $_mailer;


    /**
     * @access public
     * @param Loader $loader 
     * @return void
     */

    public function __construct(Loader $loader)
    {
        $this->_token  = $loader->service('token');
        $this->_mailer = $loader->service('email');
    }


    /**
     * @access public
     * @return void
     */

    public function index()
    {
        $data['token'] = $this->_token->createToken();
        $this->generateView('home/home', $data);
    } 


    /**
     * @access public
     * @return void
     */   

    public function contact()
    {
        $this->_token->checkToken();
        
        $name       = $this->_request->getParameter("name");
        $first_name = $this->_request->getParameter("first_name");
        $email      = $this->_request->getParameter("email");
        $message    = $this->_request->getParameter("message");
        $username   = $first_name.' '.$name;

        $this->_mailer->subject('Message de '.$username);
        $this->_mailer->from([$email => $username]);
        // $this->_mailer->to(['email address' => 'Blog Professionnel']);
        $this->_mailer->message($message);

        $this->_mailer->send();
        header('Location: ' .BASE_URL. 'home');

        /*if ( ! $this->_mailer->send()) {
            throw new \Exception("Le mail n'a pas été pas envoyé !");
        } else {
            header('Location: ' .BASE_URL. 'home');
        }*/
    }
}