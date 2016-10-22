$(document)
	.ajaxStart(function() { Pace.restart(); })
	.on('keyup', '.auto-slug', function(){
		var val = $(this).val();
		$(this).val(convert_to_slug(val));
	})
	.on('keyup', '.copyto', function(){
		var value = $(this).val();
		var element = $(this).attr('data-copyto');
		var datatype = $(this).attr('data-copyas');
		switch (datatype)
		{
			case 'slug':
				$(element).val(convert_to_slug(value));
				break;
			default:
				$(element).val(value);
				break;
		}
	})
	.on('click', '.confirm-action', function(e){
		e.preventDefault();
		if (this.tagName == 'A')
		{
			var href = this.href;
			var msg = $(this).attr('confirm-message');
			msg = ((typeof msg !== 'undefined') && (msg != '')) ? msg : 'Are you sure to continue the action?';
			bootbox.confirm({
				size: 'small',
				title: 'Confirmation',
				message: msg,
				callback: function(result)
				{
					if (result)
					{
						window.location.href = href;
					}
				}
			});
		}
		else
		{
			alert(".confirm-action is for 'a' tag only");
		}
	});

function convert_to_slug(str)
{
	return str.toLowerCase().replace(/[^a-zA-Z0-9]+/g,'-');
}

$('.date_picker').datetimepicker({
	format: 'YYYY-MM-DD'
});
$('.date_picker_mview').datetimepicker({
	format: 'YYYY-MM-DD',
	viewMode: 'months'
});
$('.date_picker_yview').datetimepicker({
	format: 'YYYY-MM-DD',
	viewMode: 'years'
});
$('.date_time_picker').datetimepicker();