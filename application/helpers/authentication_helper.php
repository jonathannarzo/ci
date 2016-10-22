<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Generate hash
 * @param string
 * @return string
 */
function auth_hash($str)
{
	return password_hash($str, PASSWORD_BCRYPT, ['cost' => 11]);
}

/**
 * Check if user is logged in
 * usage :
 * 		authenticate() -> Needs only to be logged in
 * 		authenticate('admin', 'editor') -> Needs admin or editor privilege to access the page
 * @return void
 */
function authenticate()
{
	$CI =& get_instance();
	$user_data = $CI->session->userdata('logged_in');

	if( ! $user_data)
	{
		redirect('authentication');
	}
	elseif(func_num_args() > 0)
	{
		if ( ! in_array($user_data->user_type_code, func_get_args()))
		{
			show_404();
		}
	}
	else
	{
		$user_data->last_activity_time = time();
	}
}