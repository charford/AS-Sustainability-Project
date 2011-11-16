<center>                       
<?php
if(isset($login_failed)) {
echo '<font color="red">Login failed, please try again.</font><br>';
}
else {
	echo 'Please login to continue';
}
?>
<form name='login' method='post' action='login.php'>
Username: <input type='text' size='20' name='username'><br>
Password: <input type='password' size='20' name='password'><br>
<?php echo "<input type='hidden' value='$index_file' name='index_file'>"; ?>
<input type='submit' value='Login'>
<input type='reset' value='Reset'>
</center>
</form>

