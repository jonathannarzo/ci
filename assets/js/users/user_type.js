var submit_type = 'create';

$(document)
	.on('submit', '#create-usertype-form', function(){
		var form = $(this);
		bootbox.confirm({
			size: 'small',
			title: 'Confirmation',
			message: 'Are you sure to continue creating user type?',
			callback: function(result)
			{
				if (result)
				{
					submit_create_usertype_form(form);
				}
			}
		});
		return false;
	})
	.on('click', '#create_type', function(){
		submit_type = 'create';
	})
	.on('click', '.edit_type', function(){
		submit_type = 'update';
		var form = document.getElementById('create-usertype-form');
		var type_id = $(this).parents('tr:first').find('td.type_id').text();
		var type_code = $(this).parents('tr:first').find('td.type_code').text();
		var type_description = $(this).parents('tr:first').find('td.type_description').text();
		var permission_level = $(this).parents('tr:first').find('td.permission_level b').text();
		console.log(permission_level);
		form.elements['type_id'].value = type_id;
		form.elements['usertype[code]'].value = type_code;
		form.elements['usertype[description]'].value = type_description;
		form.elements['usertype[permission_level]'].value = permission_level;
		$('#create-usertype-modal').modal('show');
		return false;
	});

function submit_create_usertype_form(form)
{
	var url = (submit_type === 'create') ? 'user_types/create_user_type' : 'user_types/update_user_type';
	var success_msg = 'User Type successfully created.';
	var failed_msg = 'Failed creating user type';

	if (submit_type === 'update')
	{
		success_msg = 'User Type successfully updated.';
		failed_msg = 'Failed updating user type';
	}

	$.ajax({
		url: base_url(url),
		type: 'POST',
		dataType: 'json',
		data: form.serialize(),
		success: function(data)
		{
			if (data.success)
			{
				bootbox.alert({
					className: 'modal-success',
					size: 'small',
					title: 'Notice',
					message: success_msg,
					callback: function(){
						window.location.reload();
					}
				});
			}
			else
			{
				if (typeof data.form_error !== 'undefined')
				{
					show_form_errors(form, data.form_error);
				}
				else
				{
					bootbox.alert({
						className: 'modal-danger',
						size: 'small',
						title: 'Notice',
						message: failed_msg,
						callback: function(){}
					});
				}
			}
		}
	});
}