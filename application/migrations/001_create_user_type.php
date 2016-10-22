<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_type extends CI_Migration {

    public function up()
    {
        $this->db->query("CREATE TABLE `user_type` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` VARCHAR(32) NOT NULL,
            `description` TEXT NOT NULL,
            `permission_level` INT(2) NOT NULL DEFAULT 2,
            `is_deleted` INT(1) NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `user_type_code` (`code`)
        )");
    }

    public function down()
    {
        $this->dbforge->drop_table('user_type');
    }
}