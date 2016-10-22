<?php

class MY_Model Extends CI_Model
{
	private $ci;
	
	public function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
	}

}