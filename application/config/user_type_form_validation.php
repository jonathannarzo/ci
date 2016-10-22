<?php
$config['user_type_validation'] = array(
	array(
		'field' => 'usertype[code]',
		'label' => 'User Type Code',
		'rules' => 'required|trim|callback_user_type_code_unique'
	),
	array(
		'field' => 'usertype[description]',
		'label' => 'Description',
		'rules' => 'required|trim'
	),
	array(
		'field' => 'usertype[permission_level]',
		'label' => 'Permission level',
		'rules' => 'required|trim|numeric|greater_than_equal_to[1]'
	)
);