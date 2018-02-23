<?php 
namespace OC\BlogPost\Service;

use \OC\BlogPost\Framework\Configuration;

class Email 
{
	/**
	 * 
	 * @var Swift_SmtpTransport
	 * @access private
	 */
	private static $_transport;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private static $_transportUser;

	/**
	 * 
	 * @var Swift_Mailer
	 * @access private
	 */
	private $_mailer;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $_subject;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $_from;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $_to;

	/**
	 * 
	 * @var string
	 * @access private
	 */
	private $_message;


	/**
	 * @access public
	 * @return void
	 */

	public function __construct() 
	{
	    $this->mailer();
	}


	/**
	 * @access private
	 * @param string $user 
	 * @return void
	 */

	private static function transportUser($user)
	{
		SELF::$_transportUser = $user;
	}


	/**
	 * @access private
	 * @return Swift_SmtpTransport
	 */

	private static function transport()
	{
	    if (SELF::$_transport === null) {
	        $host     = Configuration::get("mailer_host"); 
	        $port     = Configuration::get("mailer_port"); 
	        $protocol = Configuration::get("mailer_protocol"); 
	        $user     = Configuration::get("mailer_user");
	        $password = Configuration::get("mailer_password");
	        SELF::$_transport = (new \Swift_SmtpTransport($host, $port, $protocol))
	            ->setUsername($user)
	            ->setPassword($password);

	       	SELF::transportUser($user);
	    }
	    return SELF::$_transport;
	}


	/**
	 * @access private
	 * @return void
	 */

	private function mailer()
	{
		$transport = SELF::transport();
		$this->_mailer = new \Swift_Mailer($transport);
	}


	/**
	 * @access public
	 * @param string $subject 
	 * @return void
	 */

	public function subject($subject)
	{
		$this->_subject = $subject;
	}


	/**
	 * @access public
	 * @param string $from 
	 * @return void
	 */	

	public function from($from)
	{
		$this->_from = $from;
	}


	/**
	 * @access public
	 * @param string $to 
	 * @return void
	 */	

	public function to($to)
	{
		$this->_to = $to;
	}	


	/**
	 * @access public
	 * @param string $message 
	 * @return void
	 */

	public function message($message)
	{
		$this->_message = $message;
	}


	/**
	 * @access private
	 * @return Swift_Message
	 */

	private function createMessage()
	{
		if ( ! ($this->_subject === null || $this->_from === null || $this->_message === null)) {
			if ($this->_to === null) {
				$this->to(SELF::$_transportUser);
			}
			return (new \Swift_Message($this->_subject))
					  ->setFrom($this->_from)
					  ->setTo($this->_to)
					  ->setBody($this->_message, 'text/html');
		} else {
            throw new \Exception("Il manque des paramètres à la configuration du mail !");
        }
	}


	/**
	 * @access public
	 * @return void
	 */

	public function send()
	{
		$message = $this->createMessage();
		$this->_mailer->send($message);
	}
}