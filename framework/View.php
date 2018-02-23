<?php
namespace OC\BlogPost\Framework;

class View 
{
    /**
     * 
     * @var Twig_Environnment
     * @access private
     */
    private $_twig;

    /**
     * 
     * @var string
     * @access private
     */
    private $_file;

    
    /**
     * @access public
     * @param Twig_Environnment $twig 
     * @return void
     */

    public function __construct(\Twig_Environment $twig) 
    {
        $this->_twig = $twig;
        $this->_file = 'errorView.twig';
    }


    /**
     * @access public
     * @param array $data 
     * @return void
     */

    public function generate($data = array()) 
    {
        if (file_exists('view/'.$this->_file)) {
            $data['base_url'] = BASE_URL;
            echo $this->_twig->render($this->_file, $data);
        } else {
            throw new \Exception('Fichier ' .$this->_file .' introuvable');
        }
    }


    /**
     * @access public
     * @param string $view 
     * @return void
     */

    public function setView($view) 
    {
        $this->_file = $view. 'View.twig';
    }
}