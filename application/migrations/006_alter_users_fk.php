<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_users_fk extends CI_Migration {

    public function up()
    {
        $this->db->query("
        	ALTER TABLE users_profile 
        	ADD CONSTRAINT users_profile_fk FOREIGN KEY (users_id) REFERENCES users (id)
        	ON UPDATE CASCADE
        	ON DELETE CASCADE");
    }

    public function down()
    {}
}