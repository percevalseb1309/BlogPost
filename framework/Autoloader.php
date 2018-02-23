<?php 
namespace OC\BlogPost\Framework;

class Autoloader
{

    /**
     * @access public
     * @return void
     */
    

    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }


    /**
     * @access public
     * @param string $class 
     * @return void
     */
    
    public static function autoload($class)
    {
        if (preg_match("#^OC\\\\BlogPost\\\\(\w+)\\\\(\w+)$#i", $class, $matches)) {
            if (isset($matches[1]) && isset($matches[2])) { 
                $folder = strtolower($matches[1]);
                $file   = $matches[2];
                if (file_exists($folder.'/'.$file.'.php')) {
                    require_once($folder.'/'.$file.'.php');
                }
            }
        }
    }
}