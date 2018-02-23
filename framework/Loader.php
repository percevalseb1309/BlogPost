<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class Loader
{
    /**
     * 
     * @var Container
     * @access private
     */
    private $_container;

    
    /**
     * @access public
     * @return void
     */

    public function __construct()
    {
        $this->_container = Container::getInstance();
    }


    /**
     * @access public
     * @param string $service 
     * @return Email|Token
     */

    public function service($service)
    {
        $serviceClassWithNamespace = "\OC\BlogPost\Service\\".ucfirst(strtolower($service));
        return $this->_container->getService($service, $serviceClassWithNamespace);
    }  


    /**
     * @access public
     * @param string $model 
     * @return PostManager|CommentManager
     */  

    public function model($model)
    {
        $modelClassWithNamespace = "\OC\BlogPost\Model\\".ucfirst(strtolower($model))."Manager";
        return $this->_container->getService($model, $modelClassWithNamespace);
    }
}