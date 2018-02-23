<?php
namespace OC\BlogPost\Framework;

class Request 
{
    /**
     * 
     * @var array
     * @access private
     */
    private $_parameters;


    /**
     * @access public
     * @param string $name 
     * @return bool
     */

    public function isParameter($name) 
    {
        return (isset($this->_parameters[$name]) && $this->_parameters[$name] != "");
    }


    /**
     * @access public
     * @param array $parameters 
     * @return void
     */

    public function setParameter(array $parameters) 
    {
        $this->_parameters = $parameters;
    }


    /**
     * @access public
     * @param string $name 
     * @return string
     */

    public function getParameter($name) 
    {
        if ($this->isParameter($name)) {
            return $this->_parameters[$name];
        }
        else {
            throw new \Exception("Paramètre '".$name."' absent de la requête");
        }
    }
}

