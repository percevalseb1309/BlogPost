<?php 
namespace OC\BlogPost\Framework;

class Configuration 
{
	/**
	 * 
	 * @var array
	 * @access private
	 */
	private static $_parameters;


	/**
	 * @access public
	 * @param string $name 
	 * @return string
	 */

	public static function get($name) 
	{
		if (isset(SELF::getParameters()[$name])) {
			return SELF::$_parameters[$name];
		}
	   	return NULL;
	}


	/**
	 * @access private
	 * @return array
	 */

	private static function getParameters() 
	{ 
		if (SELF::$_parameters == NULL) {
			switch (ENVIRONMENT) {
				case 'development':
					$filePath = "config/dev.ini";
					break;				

				case 'production':
					$filePath = "config/prod.ini";
					break;
				
			}
			if ( ! file_exists($filePath)) {
			    throw new \Exception("Aucun fichier de configuration trouvé");
			}
			SELF::$_parameters = parse_ini_file($filePath);
		}
		return SELF::$_parameters;
	}
}