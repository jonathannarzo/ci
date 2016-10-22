<?php

class Authentication_model extends CI_Model
{
	public function find_user($value, $column = '')
	{
		if ( ! empty($column))
		{
			$query = $this->db->select('users.*, user_type.description AS role, users_profile.first_name, users_profile.middle_name, users_profile.last_name, users_profile.gender')
			->from('users')
			->join('users_profile', 'users_profile.users_id = users.id', 'left')
			->join('user_type', 'user_type.code = users.user_type_code', 'left')
			->where($column, $value)
			->get();
			return ($query->num_rows() > 0) ? $query->row() : FALSE;
		}
		return FALSE;
	}
}