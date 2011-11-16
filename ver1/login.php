<?php
//This part of the program authenticates the user.
//It is not meant to be called directly from web browser, but
//instead it is meant to be called through a form action="login.php"
	ob_start();
	include 'functions.php';
	include 'mysql_settings.php';
	$index_file = $_POST['index_file'];

	//get username and password from form
	$myusername = $_POST['username']; 
	$mypassword = $_POST['password'];
	
	//protection against mysql injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);

	//encrypting password
	$encrypted_mypassword=md5($mypassword);
	
	//lets see if they exist in the table admin
	//mysql_query("insert into $db_tbl (username,password) values ('$myusername','$encrypted_mypassword')");
	$sql = "SELECT * FROM admin WHERE username='$myusername' and password='$encrypted_mypassword'";
	$result=mysql_query($sql);

	//given that mysql returns a row number, we know if there exists a 
	//user that matches, it will return a row count of 1
	$count=mysql_num_rows($result);
	if($count==1) {
		//register $myusername,$mypassword and redirect to the main page, depending on if the user is an admin or moderator.
		//creates a session
		session_start();
		$_SESSION['myusername'] = $myusername;
		$_SESSION['mypassword'] = $mypassword;
		$_SESSION['myuserip'] = VisitorIP();
		$_SESSION['mylogintype'] = 0;	//needs to be changed to reflect if user is admin or moderator 0=admin 1=moderator
		
		//redirect to main.php
		header("location:$index_file");
	}
	else {
		//check moderator table
		$sql = "SELECT * FROM moderator WHERE username='$myusername' and password='$encrypted_mypassword'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		if($count==1) {
		
			session_start();
			$_SESSION['myusername'] = $myusername;
			$_SESSION['mypassword'] = $mypassword;
			$_SESSION['myuserip'] = VisitorIP();
			$_SESSION['mylogintype'] = 1;	//needs to be changed to reflect if user is admin or moderator 0=admin 1=moderator
		
			//redirect to main.php
			header("location:$index_file");
		}
		else {
		//login failed
		header("location:login_failed.php");
		}
	}
ob_end_flush();	
?>
