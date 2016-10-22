$(document)
.on('click', '#change-pass-check', function(){
	var check_stat = this.checked;
	$('#password-change-div input[type=password]').prop('disabled', !check_stat);
});

$('#profile-tabs a').click(function(e) {
	e.preventDefault();
	$(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
	var id = $(e.target).attr("href").substr(1);
	window.location.hash = '!' + id;
	return false;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash.replace('!', '');
$('#profile-tabs a[href="' + hash + '"]').tab('show');