<?php
	session_start();
	session_destroy();
	header("location:main.php");	//change if we add modifications below...for now, we'll redirect to login page.
	//we can put code below to display some sort of confirmation that the user has logged out
?>
