<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		authenticate('admin'); // Check if user is authenticated | only admin can view all users
		$this->page_title = 'Users';
		$this->_add_resource('js', 'assets/js/users/users.js');
		$this->view_data['app_message'] = $this->_app_msg();
		$this->load->model(['Users_model', 'User_types_model']);
	}

	public function index()
	{
		$this->view_data['users'] = $this->Users_model->get_users_data();
		$user_type_codes = $this->User_types_model->get_user_types();
		$ut_codes = array('' => '-- Select User Type --');
		if ($user_type_codes)
		{
			foreach ($user_type_codes as $utc)
			{
				$ut_codes[$utc->code] = $utc->description;
			}
		}
		$this->view_data['user_type_codes'] = $ut_codes;
	}

	public function disable_user($user_id)
	{
		if ($this->Users_model->update_user(['is_disabled' => 1], ['id' => $user_id]))
		{
			redirect_back();
		}
		else
		{
			die("Failed to disable user {$user_id}");
		}
	}

	public function enable_user($user_id)
	{
		if ($this->Users_model->update_user(['is_disabled' => 0], ['id' => $user_id]))
		{
			redirect_back();
		}
		else
		{
			die("Failed to enable user {$user_id}");
		}
	}

	/* Soft Delete user */
	public function delete_user($user_id)
	{
		if ($this->Users_model->update_user(['is_deleted' => 1], ['id' => $user_id]))
		{
			redirect_back();
		}
		else
		{
			die("Failed to delete user {$user_id}");
		}
	}

	public function reset_password()
	{
		if ( ! isset($_POST['reset_password'])) show_404();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
		$result = array('success' => false);
		if ($this->form_validation->run())
		{
			$user_id = $this->input->post('user_id');
			$password = $this->input->post('password');
			$result['success'] = (bool) $this->Users_model->update_user(['password' => auth_hash($password)], ['id' => $user_id]);
		}
		else
		{
			$result['form_error'] = $this->form_validation->error_array();
		}

		echo json_encode($result);
		die();
	}

	public function recycle_bin()
	{
		// Get All deleted users
		$this->view_data['users'] = $this->Users_model->get_users_data(FALSE, TRUE);
	}

	public function retrieve($user_id)
	{
		if ($this->Users_model->update_user(['is_deleted' => 0], ['id' => $user_id]))
		{
			$this->_app_msg('success', "User <b>(ID: {$user_id})</b> successfully retrieved.");
		}
		else
		{
			die("Failed to retrieve user {$user_id}");
		}
	}
}