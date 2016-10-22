<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
	private $user_id;
	private $info_validation;
	public $selected_user = FALSE;
	public function __construct()
	{
		parent::__construct();
		authenticate(); // Check if user is authenticated
		$this->page_title = 'Profile';
		$this->_add_resource('js', 'assets/js/users/login_details.js'); // Load page resources css/js
		$this->view_data['app_message'] = $this->_app_msg();
		$this->load->model('Users_model');
		$this->config->load('user_form_validation', TRUE); // load validation config file
		$this->info_validation = $this->config->item('info_validation', 'user_form_validation');
	}

	/**
	 * Get profile of the current logged in OR selected user
	 * @param int
	 * @return void
	 */
	public function index($selected = FALSE)
	{
		$this->selected_user = $selected;
		if ($this->selected_user)
		{
			authenticate('admin'); // Only admin can view datas of specific user
			$this->user_id = $this->selected_user;
		} else $this->user_id = $this->_user->id; // Set user id to current logged in user

		$this->view_data['profile_data'] = $this->Users_model->get_users_data($this->user_id); // Get profile of the user

		// Update login details
		if (isset($_POST['change_login_details']))
		{
			$this->change_login_details();
		}

		// Update profile datas
		if (isset($_POST['update_profile']))
		{
			$this->update_profile();
		}
	}
	
	/**
	 * Create profile using ajax and json
	 * @return void
	 */
	public function create_profile()
	{
		if ( ! isset($_POST['create_profile'])) show_404();

		$result = array('success' => FALSE);

		$this->user_id = NULL; // set to null for new user;
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->info_validation['login_details']); // Validate login details
		if ($this->form_validation->run())
		{
			$this->form_validation->set_rules($this->info_validation['profile']); // Validate profile details
			if ($this->form_validation->run())
			{
				$profile = $_POST['profile'];
				$is_duplicated = $this->Users_model->has_matching_infos($profile);
				if ($is_duplicated)
				{
					$result['duplicated_info'] = $is_duplicated;
					$result['success'] = FALSE;
				}
				else
				{
					$user = $_POST['user'];
					$user['password'] = auth_hash($_POST['conpassword']);
					$create_user = $this->Users_model->create_user($user);
					if ($create_user)
					{
						$profile['users_id'] = $create_user;
						if ($this->Users_model->create_user_profile($profile))
						{
							$result['success'] = TRUE;
						}
						else
						{
							$result['success'] = FALSE;
						}
					}
					else
					{
						$result['success'] = FALSE;
					}
				}
			}
			else
			{
				$result['profile_form_error'] = $this->form_validation->error_array();
			}
		}
		else
		{
			$result['login_form_error'] = $this->form_validation->error_array();
		}
		echo json_encode($result);
		die();
	}

	/**
	 * Update login details (email, username)
	 * @return void
	 */
	public function change_login_details()
	{
		if (!isset($_POST['change_login_details'])) show_404();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules($this->info_validation['change_user']);
		if (isset($_POST['change_password']))
		{
			$this->form_validation->set_rules($this->info_validation['change_password']);
		}

		if ($this->form_validation->run())
		{
			$user = $_POST['user'];
			if (isset($_POST['change_password'])) $user['password'] = auth_hash($_POST['conpassword']);
			$where = array('id' => $this->user_id);
			if ($this->Users_model->update_user($user, $where))
				$this->_app_msg('success', 'Login Details Saved.');
		}
	}

	/**
	 * Update profile details
	 * @return void
	 */
	public function update_profile()
	{
		if (!isset($_POST['update_profile'])) show_404();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		$this->form_validation->set_rules($this->info_validation['profile']);
		if ($this->form_validation->run())
		{
			$data = $_POST['profile'];
			if ($this->Users_model->has_profile($this->user_id))
			{
				$where = array('users_id' => $this->user_id);
				if ($this->Users_model->update_user_profile($data, $where))
				{
					$this->Users_model->update_user(['updated_at' => date('Y-m-d H:i:s')], ['id' => $this->user_id]); // Updated at
					$this->_user_session($data);
					$this->_app_msg('success', 'Profile Saved.');
				}
			}
			else
			{
				$data['users_id'] = $this->user_id;
				if ($this->Users_model->create_user_profile($data))
				{
					$this->_user_session($data);
					$this->_app_msg('success', 'Profile Saved.');
				}
			}
		}
	}

	private function _user_session($data = array())
	{
		if ($data && ( ! $this->selected_user))
		{
			$session_data = $this->session->userdata('logged_in');
			$session_data->first_name = $data['first_name'];
			$session_data->middle_name = $data['middle_name'];
			$session_data->last_name = $data['last_name'];
			$session_data->gender = $data['gender'];
			$this->session->set_userdata('logged_in', $session_data);
		}
	}

	/**
	 * Check if entered current password matches with the record in the database
	 * @param string
	 * @return bool
	 */
	public function currpassword_check($password)
	{
		$this->load->model('Authentication_model');
		$user_data = $this->Authentication_model->find_user_by_id($this->user_id);
		if ($user_data && password_verify($password, $user_data->password))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('currpassword_check', 'Current password not match');
			return FALSE;
		}
	}

	/**
	 * Check if entered email is unique
	 * @param string
	 * @return bool
	 */
	public function email_unique($email)
	{
		$this->load->model('Authentication_model');
		$user = $this->Authentication_model->find_user($email, 'email');
		if ($user)
		{
			if ($user->id != $this->user_id)
			{
				$this->form_validation->set_message('email_unique', 'Email already in used by other user');
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * Check if entered username is unique
	 * @param string
	 * @return bool
	 */
	public function username_unique($username)
	{
		$this->load->model('Authentication_model');
		$user = $this->Authentication_model->find_user($username, 'username');
		if ($user)
		{
			if ($user->id != $this->user_id)
			{
				$this->form_validation->set_message('username_unique', 'Username already in used by other user');
				return FALSE;
			}
		}
		return TRUE;
	}

}