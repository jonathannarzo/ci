<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_users extends CI_Migration {

    public function up()
    {
		$data = array(
			array(
				'email' => "admin@mail.com",
				'username' => "admin",
				'password' => auth_hash("admin"),
				'user_type_code' => 'admin'
			)
		);
		$this->db->insert_batch('users', $data);
    }

    public function down()
    {
    	$this->db->query("TRUNCATE TABLE `users`");
    }
}