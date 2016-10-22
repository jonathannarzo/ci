<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->template_view = 'login';
		$this->page_title = 'App Login';
		$this->body_tag_class = 'hold-transition login-page';
		$this->view_data['app_message'] = $this->_app_msg();
	}

	public function index()
	{
		if (isset($_POST['login']))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user', 'Username', 'trim|required');
			$this->form_validation->set_rules('pass', 'Password', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{
				$this->_app_msg('error', 'Username and password is required', 'authentication');
			}
			else
			{
				$username = $_POST['user'];
				$password = $_POST['pass'];

				$this->load->model('Authentication_model');

				// Check if submitted values is an email
				if (filter_var($username, FILTER_VALIDATE_EMAIL))
					$user_check = $this->Authentication_model->find_user($username, 'email');
				else
					$user_check = $this->Authentication_model->find_user($username, 'username');

				if ($user_check)
				{
					if (password_verify($password, $user_check->password))
					{
						if ($user_check->is_deleted)
						{
							$this->_app_msg('error', 'Invalid username or password', 'authentication');
						}
						elseif ($user_check->is_disabled)
						{
							$this->_app_msg('error', 'Your account has been <b>Deactivated</b>', 'authentication');
						}
						else
						{
							unset($user_check->password);
							$this->load->model('Users_model');
							$this->session->set_userdata('logged_in', $user_check);
							$this->_app_msg('success', 'Login Success', 'profile');
						}
					}
					else
					{
						$this->_app_msg('error', 'Invalid username or password', 'authentication');
					}
				}
				else
				{
					$this->_app_msg('error', 'Invalid username or password', 'authentication');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('authentication', 'refresh');
	}

}