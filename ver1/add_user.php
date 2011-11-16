<?php


//Display add user form
if($action=="add_user" || $action=="modify_user") {
	if($action=="modify_user") {
		$intro_text="Make necessary changes below, then press Modify.";
		$submit_value="Modify";
		include 'mysql_settings.php';
		if(isset($_GET['email'])) {
			$email=$_GET['email'];

			//sql to get current user info
			$sql = "SELECT * FROM person WHERE email='$email'";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				$f_name=$row['f_name'];
				$l_name=$row['l_name'];
				$gender=$row['gender'];
				$phone=$row['phone'];
			}
			$sql = "SELECT * FROM volunteer WHERE email='$email'";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
				$subscribed=$row['subscribed'];
				$g_level=$row['g_level'];
				$major=$row['major'];
				$notes=$row['notes'];
			}
			//event types/interest
			$sql = "SELECT gnum FROM interested_in WHERE email='$email'";
			$result = mysql_query($sql);
			$event_types=array(0,0,0,0,0,0,0,0);
			while ($row = mysql_fetch_array($result)) {
				$index=$row['gnum'];
				
				$event_types[$index]=1;
			}
			$total_event_types=$i;
		}
		$action="$index_file?action=modify_user2";
	}
	else {
		$intro_text="
		Enter the required information below to add a new person. 
		<br>Need to add more than 1 person? 
		<a href='$index_file?action=import_excel'>Click here</a> to import an Excel spreadsheet.";
		$action="$index_file?action=add_user2";
		$submit_value="Submit";
	}
echo "
<center>
$intro_text
</center>
<div class='cont_header'>Personal info</div>
<form action='$action' method='post'>
First name: <input type='text' size='20' id ='f_name' name='f_name' value='$f_name'>
Last name: <input type='text' size='20' name='l_name' value='$l_name'>
Gender: <select name='gender'>";
$gender_select=array(
	0=>'Select',
	1=>'F',
	2=>'M'	
);
for($i=0;$i<3;$i++) {
	if($gender_select[$i]==$gender) {
		echo "<option selected='selected'>$gender_select[$i]</option>";
	}
	else {
		echo "<option>$gender_select[$i]</option>";
	}
}
echo "
</select><br>
Email: <input type='text' size='20' name='email' value='$email' id='email' />
Phone: <input type='text' size='20' name='phone' value='$phone' /><br>
Major: <input type='text' size='20' name='major' value='$major' />
Grade Level: <select name='g_level'>";
$g_level_select = array(
	0=>'Select',
	1=>'Freshman',
	2=>'Sophmore',
	3=>'Junior',
	4=>'Senior',
	5=>'Graduate'
);
for($i=0;$i<6;$i++) {
	if($g_level==$g_level_select[$i]) echo "<option value='$g_level_select[$i]' selected='selected'>$g_level_select[$i]</option>";
	else echo "<option value='$g_level_select[$i]'>$g_level_select[$i]</option>";
}
echo "
</select><br>
	
<div class='cont_header'>Event Interest</div>
	
Please select which types of events this person is interested in.<br>
<input type='checkbox' name='groups[]' value='0'";
if($event_types[0]==1) echo " checked='checked'";
echo ">AS Recycling Program<br>
<input type='checkbox' name='groups[]' value='1'"; 
if($event_types[1]==1) echo " checked='checked'";
echo ">AS Sustainability Program<br>
<input type='checkbox' name='groups[]' value='2'"; 
if($event_types[2]==1) echo " checked='checked'";
echo ">Envivronmental Action & Resource Center<br>
<input type='checkbox' name='groups[]' value='3'";
if($event_types[3]==1) echo " checked='checked'";
echo ">Recycling And Rubbish Exhibit<br>
<input type='checkbox' name='groups[]' value='4'"; 
if($event_types[4]==1) echo " checked='checked'";
echo ">Green Campus Program<br>
	
<div class='cont_header'>Event Types</div>
Please select the types of events this person would like to be involved with.<br>
<input type='checkbox' name='groups[]' value='5'"; 
if($event_types[5]==1) echo " checked='checked'";
echo "> Paid<br>
<input type='checkbox' name='groups[]' value='6'"; 
if($event_types[6]==1) echo " checked='checked'";
echo "> Volunteer<br>
<input type='checkbox' name='groups[]' value='7'"; 
if($event_types[7]==1) echo " checked='checked'";
echo "> Internship<br>
<div class='cont_header'>E-mail List</div>
<input type='checkbox' name='subscribed' value='1'";
if ($subscribed==1) echo " checked='checked'";
echo "> Subscribe to email lists?<br>
<div class='cont_header'>Notes</div>
<textarea cols='50' rows='5' name='notes'>$notes</textarea><br>
<input type='submit' value='$submit_value' onclick='return adduserValidator(); return false;' />
<input type='reset' value='Reset' />
</form>
";
}
//preview and confirm
elseif ($action=="add_user2" || $action=="modify_user2") {
	if($action=="modify_user2") $submit_value="Modify User";
	else $submit_value="Add User";
	if($action=="add_user2") $action="$index_file?action=add_user3";
	if($action=="modify_user2") $action="$index_file?action=modify_user3";
	include 'mysql_settings.php';
	//store values from post into variables
	$f_name=$_POST['f_name'];
	$l_name=$_POST['l_name'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$subscribed=$_POST['subscribed'];
	$g_level=$_POST['g_level'];
	$phone=$_POST['phone'];
	$major=$_POST['major'];
	$notes=$_POST['notes'];
	echo "
	<center>The following user information will be added to the database. Click $submit_value to continue.<br>
	<form action='$action' method='post'>
	<input type='submit' value='$submit_value' /></center>
	<div class='cont_header'>Personal Info</div>
	<b>Name:</b> $f_name $l_name<br>
	<b>Email:</b> $email<br>
	<b>Phone:</b> $phone<br>
	<b>Major:</b> $major<br>
	<b>Gender:</b> $gender<br>
	<b>Grade Level:</b> $g_level<br>
	
	<input type='hidden' name='f_name' value='$f_name' />
	<input type='hidden' name='l_name' value='$l_name' />
	<input type='hidden' name='gender' value='$gender'/>
	<input type='hidden' name='email' value='$email' />
	<input type='hidden' name='g_level' value='$g_level' />
	<input type='hidden' name='subscribed' value='$subscribed' />
	<input type='hidden' name='phone' value='$phone' />
	<input type='hidden' name='major' value='$major' />
	<input type='hidden' name='notes' value='$notes' />
	<div class='cont_header'>Event Interest And Types</div>";
	
	//for each item in array, store it as a hidden variable to send to the next section
	foreach ($_POST['groups'] as $value) {
		echo "<input type='hidden' name='groups[]' value='$value' />";
			$sql = "SELECT gtype FROM groups WHERE gnum='$value'";
			$result = mysql_query($sql);
			//retrieving gtypes from groups based on gnum in array passed by POST
			while ($row = mysql_fetch_array($result))
			{
				echo $row['gtype'] . "<br>";
			}
	}
	
	echo "
	<div class='cont_header'>E-mail List</div>
	Subscribed to email lists? ";
	if($subscribed=='1') echo "Yes";
	else echo "No";
	echo "
	</form>
	<form action='$index_file?action=add_user'>
	<input type='submit' value='Cancel' />
	</form>
	";
}
//SQL statements below plus display confirmation
elseif ($action=="add_user3" || $action="modify_user3") {
	include 'mysql_settings.php';
        $f_name=$_POST['f_name'];
        $l_name=$_POST['l_name'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
	$subscribed=$_POST['subscribed'];
        $g_level=$_POST['g_level'];
        $phone=$_POST['phone'];
        $major=$_POST['major'];
	$notes=$_POST['notes'];
	
	//protection against mysql_injection
	$f_name=stripslashes($f_name);
	$l_name=stripslashes($l_name);
	$gender=stripslashes($gender);
	$email=stripslashes($email);
	$subscribed=stripslashes($subscribed);
	$g_level=stripslashes($g_level);
	$phone=stripslashes($phone);
	$major=stripslashes($major);
	$notes=stripslashes($notes);
	
	//protection against mysql_injection
	$f_name=mysql_real_escape_string($f_name);
	$l_name=mysql_real_escape_string($l_name);
	$gender=mysql_real_escape_string($gender);
	$email=mysql_real_escape_string($email);
	$subscribed=mysql_real_escape_string($subscribed);
	$g_level=mysql_real_escape_string($g_level);
	$phone=mysql_real_escape_string($phone);
	$major=mysql_real_escape_string($major);
	$notes=mysql_real_escape_string($notes);
	
	//insert into person table

	if($action=="modify_user3") {
	$sql = "INSERT INTO person (email,f_name,l_name,phone,gender)
		VALUES ('$email','$f_name','$l_name','$phone','$gender')
		ON DUPLICATE KEY UPDATE f_name='$f_name',l_name='$l_name',phone='$phone',gender='$gender'";
	}
	else {
	$sql = "INSERT INTO person (email,f_name,l_name,phone,gender)
		VALUES ('$email','$f_name','$l_name','$phone','$gender')";
	}
	//process sql query or error out
	if(!mysql_query($sql)) {
		die('insert into person Error: ' . mysql_error());
	}	

	//insert into interested_in table
	foreach ($_POST['groups'] as $value) {	//$value is the interested_in value
		//mysql injection protection
		$value = stripslashes($value);
		$value = mysql_real_escape_string($value);
		if($action=="modify_user3") {
		$sql = "INSERT INTO interested_in (email,gnum)
			VALUES ('$email','$value')
			ON DUPLICATE KEY UPDATE gnum='$value'";
		}

		else {
		$sql = "INSERT INTO interested_in (email,gnum)
			VALUES ('$email','$value')";
		}
		//process query or error out
		if(!mysql_query($sql)) {
			die('insert into interested_in Error: ' .mysql_error());
		}
	}

	//insert into volunteer
	if($action=="modify_user3") {
	$sql = "INSERT INTO volunteer (email,subscribed,g_level,major,notes)
		VALUES ('$email','$subscribed','$g_level','$major','$notes')
		ON DUPLICATE KEY UPDATE subscribed='$subscribed',g_level='$g_level',major='$major',notes='$notes'";
	}
	else {
	$sql = "INSERT INTO volunteer (email,subscribed,g_level,major,notes)
		VALUES ('$email','$subscribed','$g_level','$major','$notes')";	//ON DUPLICATE KEY UPDATE???
	}
	//process sql query or error out
	if(!mysql_query($sql)) {
		die('Error: ' . mysql_error());
	}	
	//confirmation goes here
	if($action=="modify_user3") {
		echo "<center>Successfully updated user records.</center>";
	}
	else {
		echo "<center>Successfully added new user, $f_name $l_name.</center>";
	}
}
?>
