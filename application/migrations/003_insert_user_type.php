<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_user_type extends CI_Migration {

    public function up()
    {
		$data = array(
			array(
				'code' => "admin",
				'description' => "Site Administrator",
				'permission_level' => 1
			)
		);
		$this->db->insert_batch('user_type', $data);
    }

    public function down()
    {
    	$this->db->query("TRUNCATE TABLE `user_type`");
    }
}