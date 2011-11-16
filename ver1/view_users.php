<?php
//ini_set('display_errors','On');

	//display list of users
	if($action=="view_users" || $action=="delete_user") {
	include 'mysql_settings.php';
	if(isset($_GET['sortby'])) {
		$sortby = stripslashes($_GET['sortby']);
		$sortby = mysql_real_escape_string($sortby);
	}
	else {
	$sortby = "";
	}

		if($action=="view_users") {
			echo "<center>Click view for more details about user.";
			if($mylogintype==0) echo " Click modify to change user details.";
			echo "<br>";
		}
		elseif($action=="delete_user") {
			if($mylogintype==0) echo "<center>Click Delete to remove all records of a user.<br>";
			else header("location:$index_file");
		}
		//display alphabet for sorting by last name
		foreach(range('A','Z') as $i) {
			echo "<a href='$index_page?action=$action&sortby=$i'>$i</a> ";
		}
	
		echo "<a href='$index_page?action=$action'>All</a>
		<br>Sort by last name.</center>
		<div class='cont_header'>Users</div>
		<div class='tbl_container'>";
		$sql = "SELECT f_name,l_name,email,phone FROM person WHERE l_name LIKE '$sortby%'";
		$result = mysql_query($sql);
		if(!$result) {
			die('SELECT Error: ' . mysql_error());
		}
		//i may go back and add an if statement to check $_SESSION['myusertype'], if they are admin, display modify.
		echo "<div class='tbl_row'>
			<div class='tbl_cell'><b>Last Name</b></div>
			<div class='tbl_cell'><b>First Name</b></div>
			<div class='tbl_cell_email'><b>Email</b></div>
			&nbsp
			</div>";
		while ($row = mysql_fetch_array($result)) {
			echo "<div class='tbl_row'>
				<div class='tbl_cell'>".$row['l_name']."&nbsp</div>
				<div class='tbl_cell'>".$row['f_name']."&nbsp</div>		
				<div class='tbl_cell_email'><a href='mailto:".$row['email']."'>".$row['email']."</a></div>";
				
				if($action=="view_users") {
					if($mylogintype==0) echo "<div class='tbl_cell_right'><a href='$index_file?action=modify_user&email=".$row['email']."'>Modify</a></div>";		
				echo "<div class='tbl_cell_right'><a href='$index_file?action=".$action."2&email=".$row['email']."'>View</a></div>";		
				}
				elseif($action=="delete_user") {
					if($mylogintype==0) {
						echo "<div class='tbl_cell_right'><a href='$index_file?action=delete_user2&email=".$row['email']."'>Delete</a></div>";
					}
				}
				echo "&nbsp</div>";
		}
				
	echo "	</div>
		";
	}
	//display user details
	elseif($action=="view_users2") {
		include 'mysql_settings.php';
		$email=$_GET['email'];
		$sql = "SELECT * FROM person,volunteer WHERE person.email='$email'";
		$result = mysql_query($sql);
		if(!$result) {
			die('Error: ' . mysql_error());
		}
		while ($row = mysql_fetch_array($result)) {
			$f_name=$row['f_name'];
			$l_name=$row['l_name'];
			$phone=$row['phone'];
			$gender=$row['gender'];
			$subscribed=$row['subscribed'];
			$g_level=$row['g_level'];
			$major=$row['major'];
			$notes=$row['notes'];
		}
		echo "
		<div class='cont_header'>Personal Info</div>
		Name: $f_name $l_name<br>
		Gender: $gender<br>
		Email: <a href='mailto:$email'>$email</a><br>
		Phone: $phone<br>
		Major: $major<br>
		Grade Level: $g_level<br>

		<div class='cont_header'>Event Interest And Types</div>";
		$sql = "SELECT gtype FROM interested_in,groups WHERE interested_in.gnum=groups.gnum";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			echo $row['gtype'] . "<br>";
		}
		
		echo "<div class='cont_header'>Email List</div>
		Subscribed? ";
		if($subscribed==1) echo "Yes<br>";
		else echo "No<br>";
		
	}
?>
