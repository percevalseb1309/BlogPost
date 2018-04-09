<?php
namespace OC\BlogPost\Framework;

class Entity 
{
	/**
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function __construct(array $parameters = array()) 
	{
		$this->hydrate($parameters);
	}

	/**
	 * @access private
	 * @param array $data
	 * @return void
	 */
	private function hydrate(array $data) 
	{
		foreach ($data as $key => $value) {
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method)) {
				if (strtotime($value)) {
				  $value = new \DateTime($value);
				}
				$this->$method($value);
			}
		}
	}
}