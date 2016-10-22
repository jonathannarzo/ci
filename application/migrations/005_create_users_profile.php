<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_profile extends CI_Migration {

    public function up()
    {
        $this->db->query("CREATE TABLE `users_profile` (
            `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `users_id` BIGINT(20) UNSIGNED NOT NULL,
            `first_name` VARCHAR(32) NOT NULL,
            `middle_name` VARCHAR(32) NOT NULL,
            `last_name` VARCHAR(32) NOT NULL,
            `birth_date` DATE NOT NULL,
            `gender` VARCHAR(6) NOT NULL,
            `phone_number` VARCHAR(32) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE (`users_id`)
        )");
    }

    public function down()
    {
        $this->dbforge->drop_table('users_profile');
    }
}