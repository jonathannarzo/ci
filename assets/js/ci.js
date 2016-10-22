// Leave empty if project index is within public folder / root folder
var project_folder = 'ci';

// Javascript version of CI base_url() method
var base_url = function(url, vars){
	var the_url = document.location.origin + '/';
	if (project_folder != '') the_url += project_folder + '/';
	if (typeof url !== 'undefined') the_url += url;
	if (typeof vars !== 'undefined')
	{
		if (vars instanceof Object)
		{
			var key = Object.keys(vars);
			var key_length = key.length;
			var stock_values = [];
			for (var i = 0; i < key_length; i++) stock_values.push(key[i] + '=' + vars[key[i]]);
			stock_values = stock_values.join('&');
			the_url += '?' + stock_values;
		}
	}
	return the_url;
};

// For Filling CI form errors
function show_form_errors(form, errors)
{
	reset_form_error(form);
	if (typeof form === 'undefined')
	{
		console.log('show_form_errors() method needs "form_id"');
	}
	else if (typeof errors === 'undefined' && !(vars instanceof Object))
	{
		console.log('show_form_errors() method, needs "errors" as object datas');
	}
	else
	{
		var keys = Object.keys(errors);
		var key_length = keys.length;
		if (key_length > 0)
		{
			var input_types = ['input', 'select', 'textarea'];
			var other_types = ['checkbox', 'radio'];
			var input_types_length = input_types.length;
			for (var i = 0; i < key_length; i++)
			{
				var input_name = keys[i];
				var input_message = errors[keys[i]];
				var form_input;
				var form_message;
				var form_highlight;
				for (var j = 0; j < input_types_length; j++)
				{
					form_input = form.find(input_types[j]+'[name="'+input_name+'"]');
					var add_newline = (other_types.indexOf(form_input.attr('type')) != -1) ? '<br/>' : '';
					if (form_input.length > 0)
					{
						form_message = form_input.parent();
						form_highlight = form_input.parents('.ci-form-validate');
						form_message.append(add_newline+'<span class="label label-danger form_error">'+input_message+'</span>');
						if (form_highlight.length > 0) form_highlight.addClass('has-error');
					}
				}
			}
		}
	}
}

// Reset CI form errors
function reset_form_error(form)
{
	form.find('div').removeClass('has-error');
	form.find('span.form_error').remove();
}