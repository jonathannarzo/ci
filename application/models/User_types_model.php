<?php

class User_types_model extends MY_Model
{
	public function get_user_types($id = FALSE, $is_deleted = FALSE)
	{
		$this->db->select('*')->from('user_type');

		if ($is_deleted) $this->db->where('is_deleted', 1);
		elseif ($id !== FALSE) $this->db->where('id', $id);
		else $this->db->where('is_deleted', 0);
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			if ($id !== FALSE)
				return $query->row();
			else
				return $query->result();
		}
	}

	public function create_user_type($data)
	{
		return $this->db->insert('user_type', $data);
	}

	public function update_user_type($data, $where)
	{
		return $this->db->update('user_type', $data, $where);
	}

	public function find_usertype_by_code($code)
	{
		$query = $this->db->select('*')
		->from('user_type')
		->where('code', $code)
		->get();
		return ($query->num_rows() > 0) ? $query->row() : FALSE;
	}
}