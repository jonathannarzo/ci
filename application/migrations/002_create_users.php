<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

    public function up()
    {
        $this->db->query("CREATE TABLE `users` (
            `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(128) NOT NULL,
            `username` VARCHAR(32) NOT NULL,
            `password` VARCHAR(60) NOT NULL,
            `user_type_code` VARCHAR(64) NOT NULL,
            `is_disabled` INT(1) NOT NULL DEFAULT 0,
            `is_deleted` INT(1) NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE (`email`),
            UNIQUE (`username`)
        )");
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}