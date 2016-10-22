$(document)
	.on('submit', '#create-user-form', function(){
		var form = $(this);
		bootbox.confirm({
			size: 'small',
			title: 'Confirmation',
			message: 'Are you sure to continue creating user?',
			callback: function(result)
			{
				if (result)
				{
					submit_create_user_form(form);
				}
			}
		});
		return false;
	})
	.on('click', '.reset-password', function(){
		var user_id = $(this).parents('tr:first').find('td.user_id').text();
		var username = $(this).parents('tr:first').find('td.username').text();
		var form = document.getElementById('reset-password-form');
		form.elements['user_id'].value = user_id;
		form.elements['username'].value = username;
		$('#reset-password-modal').modal('show');
	})
	.on('submit', '#reset-password-form', function(){
		var form = $(this);
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: form.serializeArray(),
			success:function(data){
				if (data.success)
				{
					bootbox.alert({
						className: 'modal-success',
						size: 'small',
						title: 'Notice',
						message: 'Password successfully reset',
						callback: function(){
							window.location.reload();
						}
					});
				}
				else
				{
					show_form_errors(form, data.form_error);
				}
			}
		});
		return false;
	});

function submit_create_user_form(form)
{
	$.ajax({
		url: base_url('profile/create_profile'),
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
					message: 'User data successfully saved.',
					callback: function(){
						window.location.reload();
					}
				});
			}
			else
			{
				if (typeof data.login_form_error !== 'undefined')
				{
					show_form_errors(form, data.login_form_error);
					$('.nav-tabs a[href="#login_details"]').tab('show');
				}
				else if (typeof data.profile_form_error !== 'undefined')
				{
					show_form_errors(form, data.profile_form_error);
					$('.nav-tabs a[href="#profile"]').tab('show');
				}
				else if (typeof data.duplicated_info !== 'undefined')
				{
					var info = data.duplicated_info;
					var name = info.last_name + ', ' + info.first_name + ' ' + info.middle_name;
					bootbox.confirm({
						className: 'modal-danger',
						size: 'small',
						title: 'Error',
						message: 'Data of <b>' + name.toUpperCase() + '</b> already exists.<p></p>Click "OK" to view details<br/>Click "Cancel" to enter new data.',
						callback: function(result)
						{
							if (result)
							{
								reset_form_error(form);
								duplicated_user_view(info);
							}
						}
					});
				}
			}
		}
	});
}

function duplicated_user_view(info)
{
	var html = '';
	html += '<dl class="dl-horizontal">';
	html += '<dt>First Name</dt><dd>'+ info.first_name.toUpperCase() +'</dd>';
	html += '<dt>Middle Name</dt><dd>'+ info.middle_name.toUpperCase() +'</dd>';
	html += '<dt>Last Name</dt><dd>'+ info.last_name.toUpperCase() +'</dd>';
	html += '<dt>Gender</dt><dd>'+ info.gender.toUpperCase() +'</dd>';
	html += '<dt>Birth Date</dt><dd>'+ info.birth_date +'</dd>';
	html += '<dt>Date Registered</dt><dd>'+ info.created_at +'</dd>';
	html += '</dl>';
	$('#duplicated-user-modal .modal-body').html(html);
	$('#duplicated-user-modal').modal('show');
}