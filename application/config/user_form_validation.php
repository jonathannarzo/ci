<?php
$config['info_validation'] = array(
	'login_details' => array(
		array(
			'field' => 'user[user_type_code]',
			'label' => 'User Type',
			'rules' => 'required|trim'
		),
		array(
			'field' => 'user[email]',
			'label' => 'Email',
			'rules' => 'required|trim|valid_email|callback_email_unique'
		),
		array(
			'field' => 'user[username]',
			'label' => 'Username',
			'rules' => 'required|trim|callback_username_unique'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[8]|trim'
		),
		array(
			'field' => 'conpassword',
			'label' => 'Confirm Password',
			'rules' => 'required|trim|matches[password]'
		)
	),
	'profile' => array(
		array(
			'field' => 'profile[first_name]',
			'label' => 'First Name',
			'rules' => 'required|trim|custom_alpha'
		),
		array(
			'field' => 'profile[middle_name]',
			'label' => 'Middle Name',
			'rules' => 'trim|custom_alpha'
		),
		array(
			'field' => 'profile[last_name]',
			'label' => 'Last Name',
			'rules' => 'required|trim|custom_alpha'
		),
		array(
			'field' => 'profile[birth_date]',
			'label' => 'Birth date',
			'rules' => 'required|trim'
		),
		array(
			'field' => 'profile[gender]',
			'label' => 'Gender',
			'rules' => 'required|trim'
		),
		array(
			'field' => 'profile[phone_number]',
			'label' => 'Phone Number',
			'rules' => 'required|trim'
		)
	),
	'change_user' => array(
		array(
			'field' => 'user[email]',
			'label' => 'Email',
			'rules' => 'required|trim|valid_email|callback_email_unique'
		),
		array(
			'field' => 'user[username]',
			'label' => 'Username',
			'rules' => 'required|trim|min_length[3]|callback_username_unique'
		)
	),
	'change_password' => array(
		array(
			'field' => 'curpassword',
			'label' => 'Current Password',
			'rules' => 'required|trim|callback_currpassword_check'
		),
		array(
			'field' => 'newpassword',
			'label' => 'New Password',
			'rules' => 'required|min_length[8]|trim'
		),
		array(
			'field' => 'conpassword',
			'label' => 'Confirm Password',
			'rules' => 'required|trim|matches[newpassword]'
		)
	)
);