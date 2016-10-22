<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_types extends MY_Controller
{
	private $user_type_validation;
	public function __construct()
	{
		parent::__construct();
		authenticate('admin'); // Check if user is authenticated | only admin can view all users
		$this->page_title = 'Users';
		$this->_add_resource('js', 'assets/js/users/user_type.js');
		$this->view_data['app_message'] = $this->_app_msg();
		$this->load->model('User_types_model');
		$this->config->load('user_type_form_validation', TRUE); // load validation config file
		$this->user_type_validation = $this->config->item('user_type_validation', 'user_type_form_validation');
	}

	public function index()
	{
		$this->view_data['user_types'] = $this->User_types_model->get_user_types();
	}

	public function create_user_type()
	{
		if ( ! isset($_POST['create_user_type'])) show_404();

		$result = array('success' => FALSE);
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->user_type_validation);
		if ($this->form_validation->run())
		{
			$user_type = $_POST['usertype'];
			if ($this->User_types_model->create_user_type($user_type))
			{
				$result['success'] = TRUE;
			}
		}
		else
		{
			$result['form_error'] = $this->form_validation->error_array();
		}
		echo json_encode($result);
		die();
	}

	public function update_user_type()
	{
		if ( ! isset($_POST['create_user_type']) && empty($_POST['type_id'])) show_404();

		$result = array('success' => FALSE);
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->user_type_validation);
		if ($this->form_validation->run())
		{
			$type_id = intval($_POST['type_id']);
			if ($this->User_types_model->get_user_types($type_id))
			{
				$user_type = $_POST['usertype'];
				if ($this->User_types_model->update_user_type($user_type, ['id' => $type_id]))
				{
					$result['success'] = TRUE;
				}
			}
		}
		else
		{
			$result['form_error'] = $this->form_validation->error_array();
		}
		echo json_encode($result);
		die();
	}

	public function delete_user_type($type_id)
	{
		if ($this->User_types_model->update_user_type(['is_deleted' => 1], ['id' => $type_id]))
		{
			redirect_back();
		}
		else
		{
			die("Failed to delete user type {$user_id}");
		}
	}

	public function recycle_bin()
	{
		// Get All deleted user types
		$this->view_data['user_types'] = $this->User_types_model->get_user_types(FALSE, TRUE);
	}

	public function retrieve($type_id)
	{
		if ($this->User_types_model->update_user_type(['is_deleted' => 0], ['id' => $type_id]))
		{
			$this->_app_msg('success', "User type <b>(ID: {$type_id})</b> successfully retrieved.");
		}
		else
		{
			die("Failed to retrieve user type {$type_id}");
		}
	}

	/**
	 * Check if entered user type code is unique
	 * @param string
	 * @return bool
	 */
	public function user_type_code_unique($code)
	{
		if ($this->User_types_model->find_usertype_by_code($code))
		{
			$this->form_validation->set_message('user_type_code_unique', 'User type code already exist');
			return FALSE;
		}
		return TRUE;
	}
}