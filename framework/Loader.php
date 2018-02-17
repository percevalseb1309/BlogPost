<?php
namespace OC\BlogPost\Framework;

use OC\BlogPost\Framework\Container;

class Loader
{
    private $_container;

    public function __construct()
    {
        $this->_container = Container::getInstance();
    }

    public function service($service)
    {
        $serviceClassWithNamespace = "\OC\BlogPost\Service\\".ucfirst(strtolower($service));
        return $this->_container->getService($service, $serviceClassWithNamespace);
    }    

    public function model($model)
    {
        $modelClassWithNamespace = "\OC\BlogPost\Model\\".ucfirst(strtolower($model))."Manager";
        return $this->_container->getService($model, $modelClassWithNamespace);
    }
}