<?php

class Users_model extends MY_Model
{
	public function get_users_data($id = FALSE, $is_deleted = FALSE)
	{
		$this->db->select('users.email, users.username, users.is_disabled, users.created_at, users.updated_at, user_type.description AS role, users_profile.*')
		->from('users')
		->join('users_profile', 'users_profile.users_id = users.id', 'left')
		->join('user_type', 'user_type.code = users.user_type_code', 'left');

		if ($is_deleted) $this->db->where('users.is_deleted', 1);
		elseif ($id !== FALSE) $this->db->where('users.id', $id);
		else
		{
			if ($this->session->userdata('logged_in'))
			{
				$this->db->where('users.id <>', $this->session->userdata('logged_in')->id);
			}
			$this->db->where('users.is_deleted', 0);
			$this->db->order_by('users.id', 'DESC');
		}

		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			if ($id !== FALSE)
				return $query->row();
			else
				return $query->result();
		}
	}

	public function create_user($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function create_user_profile($data)
	{
		return $this->db->insert('users_profile', $data);
	}

	public function update_user($data, $where)
	{
		return $this->db->update('users', $data, $where);
	}

	public function update_user_profile($data, $where)
	{
		return $this->db->update('users_profile', $data, $where);
	}

	public function has_profile($user_id)
	{
		$query = $this->db->select('*')->where('users_id', $user_id)->get('users_profile');
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}

	public function has_matching_infos($data)
	{
		$query = $this->db
		->select('*')
		->from('users_profile')
		->like('first_name', $data['first_name'], 'after')
		->like('middle_name', $data['middle_name'], 'after')
		->like('last_name', $data['last_name'], 'after')
		->get();
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
}