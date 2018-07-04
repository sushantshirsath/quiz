
$('#user_login').on('click', function() {
	var uemail = $('#uemail').val();
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(uemail)) {
		return true;
	}
	else {
		alert("Please enter valid email id.");
		return false;
	}
});


$('#signup').on('click', function() {
	var uemail = $('#reg-email').val();
	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (filter.test(uemail)) {
		return true;
	}
	else {
		alert("Please enter valid email id.");
		return false;
	}
});

$('#next').on('click', function() {
	if($('input[name=ans]:checked').length <= 0)
	{
		alert("Please choose atleast one option");
		return false;
	}else{
		return true;
	}
});