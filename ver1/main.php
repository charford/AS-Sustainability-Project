<?php
//ini_set('display_errors', 'On');
	//AS Sustainability Administration Database
	//Authors: Casey Harford, Arpit Shaw, Kyle Graves, Jason Johnson
	//Last Updated: 04-18-2011, by Casey
	include 'functions.php';
	//include 'mysql_settings.php';
	
	//This document will be our main index.php. Leaving it named main.php for now. Make
	//sure to rename $index_file below to the appropriate file if it is changed, such as index.php
	$index_file="main.php";	
	
	//the default value for disp_login(assuming they are logged in),
	//but this is checked below and changed to 1 if not logged in.
	$disp_login=0;

	//NOTE:	FOR SPECIFIC MODIFICATIONS TO EACH SECTION, MODIFY THE CORRESPONDING FILE		//
	//	EXAMPLE: TO MODIFY CREATE_EVENT FORM, EDIT create_event.php, INSTEAD OF THIS FILE.	//
	//	THIS FILE WILL SIMPLY 'INCLUDE' EACH PART OF THE PROGRAM.				//
	
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
	}
	else {
		$action = "main";
	}
	session_start();
	//check to see if user has been logged in yet. If not, display login page.
	//for extra security, we'll check to see if their IP has changed. This will help
	//to prevent Session hijacking.
	if(!isset($_SESSION['myusername'])) {
			//user is not logged in, so display login.
			$disp_login=1;
			$action="main";
	}
	else {
		//checking for session hijacking
		if($_SESSION['myuserip'] != VisitorIP()){
			//different ip address detected than what was originally logged, destroying session.
			header("location:logout.php");	
		}
		else {
		$myusername = $_SESSION['myusername'];
		$mylogintype = $_SESSION['mylogintype'];
		}
	}
	
?>
<html
<head>
<link href="sustain_style.css" rel="stylesheet" type="text/css" media="screen" />
<title>Associated Students Sustainability Administration</title>
<script language='JavaScript' src='form_validation.js'></script>
</head>
<body>
<div class="main">
	<div class="main_title">
	AS Sustainability
	<?php
		//checking to see if an action was specified, and if so, displaying in the title
		if($action != "main") {
			if($action=="create_event" || $action=="create_event2" || $action=="create_event3") {
				echo " - Create Event";
			}	
			elseif($action=="add_user" || $action=="add_user2" || $action=="add_user3") {
				echo " - Add User";
			}
			elseif($action=="modify_user" || $action=="modify_user2" || $action=="modify_user3") {
				echo " - Modify User";
			}
			elseif( ($action=="import_excel" || $action=="import_excel2" || $action=="import_excel3") && $mylogintype==0) {
				echo " - Import Users";
			}
			elseif($action=="view_events" || $action=="view_events2") {
				echo " - View Events";
			}
			elseif($action=="delete_event") {
				echo " - Delete Event";
			}
			elseif($action=="view_users" || $action=="view_users2") {
				echo " - View Users";
			}
			elseif($action=="delete_user" || $action=="delete_user2" || $action=="delete_user3") {
					echo " - Delete User";
			}
			elseif($action=="email_list" || $action=="email_list2") {
				echo " - Email List";
			}
			elseif($action=="event_stats") {
				echo " - Event Stats";
			}
		}
	?>
	</div>
	<?php
	if($disp_login==0) {
	echo "<div class='nav_bar'>
		<div style='float:left; position: absolute;'>Currently logged in as <b>$myusername</b>.</div>";
	if($action != "main") {
	echo "<a href='$index_file'>Main Menu </a> - ";
	}
	echo"
	<a href='logout.php'>Logout</a>
	</div>";
	}
	?>
	<div class="main_cont">
	<?php 	
		//LOGIN FORM
		if($disp_login==1) {
			include 'login_form.php';
		}

		//CREATE EVENT FORM
		elseif ($action=="create_event" || $action=="create_event2" || $action=="create_event3") {

			//need to add an if statement here to check if user has this priviledge. For now, we'll assume so.
			//if they don't have privilege, we'll redirect back to main.php. 
			include 'create_event.php';
		}

		//VIEW/MODIFY EVENTS
		elseif ($action=="view_events" || $action=="delete_event" || $action=="view_events2") {
			include 'view_events.php';
		}
		
		//GENERATE EMAIL LIST
		elseif ($action=="email_list" || $action=="email_list2") {
			include 'email_list.php';
		}
				
		//ADD USER FORM
		elseif ($action=="add_user" || $action=="add_user2" || $action=="add_user3" || $action=="modify_user" || $action=="modify_user2" || $action=="modify_user3") {
			include 'add_user.php';
		}

		//IMPORT USERS FROM EXCEL SPREADSHEET
		elseif ($action=="import_excel" || $action=="import_excel2" || $action=="import_excel3") {
			include 'import_excel.php';
		}
		//VIEW/MODIFY USERS/DELETE
		elseif ($action=="view_users" || $action=="view_users2" || $action=="delete_user" || $action=="delete_user2" || $action=="delete_user3") {
			include 'view_users.php';
		}

		//GENERATE EVENT STATS
		elseif ($action=="event_stats") {
			include 'event_stats.php';
		}
			
		//NO ACTIONS SPECIFIED(OR VALID), DISPLAY MAIN MENU
		else {
			include 'main_menu.php';
		}
	?>
	</div>
	<div>&nbsp</div>
	<a target='_blank' href="http://www.vim.org/"><img class='vim_power' src='images/vi_powered.gif' /></a>
</div>
</body>
</html>
<?php mysql_close(); //close the mysql connection ?>
