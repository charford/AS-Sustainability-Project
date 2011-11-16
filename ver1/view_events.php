<?php
if($action=="view_events" || $action=="delete_event") {
	include 'mysql_settings.php';
	if(isset($_GET['sortby'])) {
		$sortby = stripslashes($_GET['sortby']);
		$sortby = mysql_real_escape_string($sortby);
	}
	else {
		$sortby = "";
	}

	if($action=="view_events") {
		echo "<center>Click view for more details about an event.";
		if($mylogintype==0) echo " Click modify to change event details.";
		echo "<br>";
	}
	elseif($action=="delete_event") {
		if($mylogintype==0) echo "<center>Click Delete to remove all records of an event.<br>";
		else header("location:$index_file");
	}
	echo "</center>";
	//need to add sorting option here

	echo "<div class='cont_header'>Events</div>
		<div class='tbl_container'>";
	$sql = "SELECT date,name,start_time,end_time,description,rsvp_count FROM events ORDER BY date";
	$result = mysql_query($sql);
	if(!$result) {
		die('SELECT Error: ' .mysql_error());
	}
	echo "<div class='tbl_row'>
		<div class='tbl_cell'><b>Date</b></div>
		<div class='tbl_cell_wide'><b>Name</b></div>
		<div class='tbl_cell'><b>Start Time</b></div>
		<div class='tbl_cell'><b>End Time</b></div>
		<div class='tbl_cell_email'><b>RSVP</b></div>
		&nbsp
		</div>";
	while ($row = mysql_fetch_array($result)) {
		//converting from 24hour to 12hour time
		list($hour,$min,$second)=split(":", $row['start_time'], 3);
		$start_time=timeConvert('12',$hour,$min,'');
		list($hour,$min,$second)=split(":", $row['end_time'], 3);
		$end_time=timeConvert('12',$hour,$min,'');
		//
		
		
		echo "<div class='tbl_row'>
		<div class='tbl_cell'>".$row['date']."&nbsp</div>
		<div class='tbl_cell_wide'>".$row['name']."</div>
		<div class='tbl_cell'>$start_time&nbsp</div>
		<div class='tbl_cell'>$end_time&nbsp</div>
		<div class='tbl_cell_email'>".$row['rsvp_count']."</div>";

		if($action=="view_events") {
			if($mylogintype==0) echo "<div class='tbl_cell_right'><a href='$index_file?action=modify_event&date=".$row['date']."&name=".$row['name']."&start_time=".$row['start_time']."&end_time=".$row['end_time']."'>Modify</a></div>";
			echo "<div class='tbl_cell_right'><a href='$index_file?action=view_events2'>View</a></div>";
		}
		elseif($action=="delete_event") {
			if($mylogintype==0) {
				echo "<div class='tbl_cell_right'><a href='$index_file?action=delete_events2&date=".$row['date']."&name=".$row['name']."&start_time=".$row['start_time']."&end_time=".$row['end_time']."'>Delete</a></div>";
			}
		}
		echo "&nbsp</div>";
	}
echo "</div>";
}
elseif ($action=="view_events2") {
	//dummy code to satisfy phase1
	echo "<div class='cont_header'>Event Details</div>
		<b>Name:</b> Pick Up Trash Day<br>
		<b>Date:</b> 04/21/2012<br>
		<b>Start Time:</b> 8:00 am<br>
		<b>End Time:</b> 8:00 pm<br>
		<b>Primary Contact:</b> joe@microsoft.com<br>
		<b>Secondary Contact:</b> bob@kernel.org<br>
		<b>Address:</b> 1313 Ubuntu Dr, Chico, CA<br>
		<b>Description:</b> Come pick up trash with all your friends!<br>
		<div class='cont_header'>Interest Type</div>
		AS Recycling Program<br>
		AS Sustainability Program<br>
		<div class='cont_header'>Involvement Type</div>
		Paid<br>
		";
}
?>
