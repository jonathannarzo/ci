<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation
{
    function __construct($config = array())
    {
        parent::__construct($config);
    }

    function error_array()
    {
        if (count($this->_error_array) === 0)
            return FALSE;
        else
            return $this->_error_array;
    }

    function custom_alpha($str)
    {
        if (!preg_match('/^[a-zA-ZÑñ\s]+$/', $str))
        {
            $this->set_message('custom_alpha', 'This field does not accept numbers.');
            return false;
        }
    }
}