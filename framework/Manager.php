<?php 
namespace OC\BlogPost\Framework;

use \OC\BlogPost\Framework\Configuration;

abstract class Manager
{
	/**
	 * 
	 * @var PDO
	 * @access private
	 */
	private static $_db;


	/**
	 * @access protected
	 * @param string $sql 
	 * @param array $params 
	 * @return PDOStatement
	 */

	protected function executeRequest($sql, $params = null) 
	{
		if ($params == null) {
			$req = SELF::dbConnect()->query($sql);    
		}
		else {
		    $req = SELF::dbConnect()->prepare($sql);  
		    $req->execute($params);
		}
		return $req;
	}


	/**
	 * @access private
	 * @return PDO
	 */

    private static function dbConnect()
    {
    	if (SELF::$_db === null) {
			$dsn      = Configuration::get("dsn"); 
			$login    = Configuration::get("db_login");
			$password = Configuration::get("db_password");
	    	SELF::$_db = new \PDO($dsn, $login, $password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
	    }
    	return SELF::$_db;
    }    
}