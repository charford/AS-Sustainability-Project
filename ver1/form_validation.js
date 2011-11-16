function adduserValidator() {
	var f_name = document.getElementById('f_name');
	var email = document.getElementById('email');

	if(notEmpty(f_name,"A firstname is required.")) {
		if(emailValidator(email,"A valid email is required.")) {
			return true;
		}
	}
	return false;
}

function notEmpty(elem,helperMsg) {
	if(elem.value.length == 0) {
		alert(helperMsg);
		elem.focus();
		return false;
	}
	return true;
}

function emailValidator(elem,helperMsg) {
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)) {
		return true;
	}
	else {
		alert(helperMsg);
		elem.focus();
		return false;
	}
}


