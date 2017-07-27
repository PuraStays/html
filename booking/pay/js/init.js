document.createElement('section');
document.createElement('header');
document.createElement('details');
document.createElement('footer');
$(document).ready(function(e) {
    var a = $('.msg').val();
	var b = $.trim(a);
	$('.msg').val(b);
});