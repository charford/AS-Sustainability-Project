	<center>
	Login successful. Please choose from the options below to continue.
	</center>
	
	<div class="cont_header">Event Options</div>
	<div class="icon_menu">
	<center>

	<?php
		foreach($_SESSION['myptypes'] as $key=>$value) {
			echo $key.'  '.$value.'<br>';
		}
		//storing permission types into an array,need to change this into a mysql select/loop and fill it automatically based on table data
		//future: move this to login and store the array in a SESSION variable. This way we reduce the amount of querys on mysql table
	//	$ptypes=array(0 => 'Add Person', 1 => 'Add Event');
	//	$result=mysql_query("SELECT pnum FROM has_privilege where username='casey@caseyharford.com'");

		
	?>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/create-icon.png" /><br>Create New Event</a></div>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/modifyevent-icon.png" /><br>View/Modify Events</a></div>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/pastevents-icon.png" /><br>Search Events</a></div>
	</center>
	</div>
	
	<div class="cont_header">User Options</div>
	<div class="icon_menu">
	<center>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/mail-icon.png" /><br>Generate Email List</a></div>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/add-icon.png" /><br>Add User</a></div>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/modify-icon.png" /><br>View/Modify Users</a></div>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/notes-icon.png" /><br>Create/Edit Notes</a></div>
	</center>
	</div>

	<div class="cont_header">Reports</div>
	<div class="icon_menu">
	<center>
	<div class="icon"><a href="#"><img border="0" width="100pt" height="100pt" src="images/eventstats-icon.png" /><br>Generate Event Stats</a></div>
	<div class="icon">&nbsp</div>
	</center>
	</div>
