<?php 
//	This file contains the main menu that users will see once they have logged in. There are 3 sections,
//	and with in each section are icons/buttons for an action.
//--------------------------------------------------------------------------------------------------------------\\
//NOTE: ALL ICONS WERE DOWNLOADED/BARROWED FROM HTTP://WWW.ICONARCHIVE.COM, AND ARE PROPERTY OF THEIR 		\\
//	RESPECTIVE OWNERS. IF THIS PROGRAM IS USED COMMERCIALLY, THESE ICONS MUST BE CHANGED, OR LICENSED.	\\
//--------------------------------------------------------------------------------------------------------------\\
echo"
<center>
Please choose from the options below to continue.
</center>
<div class='cont_header'>Event Options</div>
<div class='icon_menu'>
<center>
<div class='icon'><a href='$index_file?action=create_event'><img border='0' width='100pt' height='100pt' src='images/create-icon.png' /><br>Create New Event</a></div>
<div class='icon'><a href='$index_file?action=view_events'><img border='0' width='100pt' height='100pt' src='images/modifyevent-icon.png' /><br>View/Modify Events</a></div>";
//this action requires admin
if($mylogintype==0) {
echo "
<div class='icon'><a href='$index_file?action=delete_event'><img border='0' width='100pt' height='100pt' src='images/delete-icon.png' /><br>Delete Event</a></div>";
}
echo "
</center>
</div>
<div class='cont_header'>User Options</div>
<div class='icon_menu'>
<center>
<div class='icon'><a href='$index_file?action=email_list'><img border='0' width='100pt' height='100pt' src='images/mail-icon.png' /><br>Generate Email List</a></div>";
//this action requires admin
if($mylogintype==0) {
echo "
<div class='icon'><a href='$index_file?action=add_user''><img border='0' width='100pt' height='100pt' src='images/add-icon.png' /><br>Add User</a></div>

<div class='icon'><a href='$index_file?action=view_users'><img border='0' width='100pt' height='100pt' src='images/modify-icon.png' /><br>View/Modify Users</a></div>
<div class='icon'><a href='$index_file?action=delete_user'><img border='0' width='100pt' height='100pt' src='images/delete-icon.png' /><br>Delete User</a></div>";
}
else {
echo "<div class='icon'><a href='$index_file?action=view_users'><img border='0' width='100pt' height='100pt' src='images/modify-icon.png' /><br>View Users</a></div>";
	
}
echo "
</center>
</div>
<div class='cont_header'>Reports</div>
<div class='icon_menu'>
<center>
<div class='icon'><a href='$index_file?action=event_stats'><img border='0' width='100pt' height='100pt' src='images/eventstats-icon.png' /><br>Generate Event Stats</a></div>
<div class='icon'>&nbsp</div>
</center>
</div>";
?>

