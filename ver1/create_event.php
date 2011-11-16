<?php
//ini_set('display_errors','On');
if($action=='create_event') {
echo "
	<center>
	To create a new event, fill in the details below.
	</center>
	<div class='cont_header'>Event Details</div>
	<form name='create_event' action='$index_file?action=create_event2' method='post'>
	Name: <input type='text' name='name' size='24' />
	Date: <select name='date_month'>";
	$months=listMonths();	
	for($i=1;$i<13;$i++) {
			//if the month is the current month, set it to selected
			if($months[$i]==Date("F")) echo "<option selected='selected' value='$i'>".$months[$i]."</option>";
			echo "<option value='$i'>".$months[$i]."</option>";
		}
		
	echo "	</select>

		<select name='date_day'>";
		for($i=1;$i<32;$i++) {
			if($i<10) $i="0".$i;
			//if the day is the current day, set it to selected
			if($i==Date("d")) echo "<option selected='selected' value='$i'>$i</option>";
			echo "<option value='$i'>$i</option>";
		}

	echo "	</select>

		<select name='date_year'>";
		for($i=Date("Y")-5;$i<Date("Y")+20;$i++) {
			//if the year is the current year, set it to selected
			if($i==Date("Y")) echo "<option selected='selected' value='$i'>$i</option>";
			else echo "<option value='$i'>$i</option>";
		}
	echo "	</select><p>
	Start Time:
	<select name='start_hour'>";
		$i=0;
		while($i<13) {
			if($i<10) $i=0 . $i;
			echo "<option value='$i'>$i</option>";
			$i++;
		}
	echo "
	</select> : 
	<select name='start_min'>";
		$i=0;
		while($i<60) {
			if($i<10) $i=0 . $i;
			echo "<option value='$i'>$i</option>";
			$i=$i+5;
		}
	echo "
	</select>
	<select name='start_ampm'>
		<option>am</option>
		<option>pm</option>
	</select>
	&nbsp &nbsp
	End Time: 
	<select name='end_hour'>";
		$i=0;
		while($i<13) {
			if($i<10) $i=0 . $i;
			echo "<option value='$i'>$i</option>";
			$i++;
		}
	echo "
	</select> : 
	<select name='end_min'>";
		$i=0;
		while($i<60) {
			if($i<10) $i=0 . $i;
			echo "<option value='$i'>$i</option>";
			$i=$i+5;
		}
	echo "
	</select>
	<select name='end_ampm'>
		<option>pm</option>
		<option>am</option>
	</select><p>
	Primary Contact: <input type='text' name='contact1' size='15' /> Secondary Contact: <input type='text' name='contact2' size='15' /><p>
	Address:<br>
	&nbsp &nbsp Street: <input type='text' name='address' size='24' />
	City: <input type='text' size='24' /> Zip: <input type='text' size='18' />
	State: <select>
	<option>CA</option>
	</select><p>
	Description: <br>
	<textarea cols='50' rows='5' name='description'></textarea><p>
	<div class='cont_header'>Interest Type</div>
	<input type='checkbox' name='groups[]' value='0'>AS Recycling Program<br>
	<input type='checkbox' name='groups[]' value='1'>AS Sustainability Program<br>
	<input type='checkbox' name='groups[]' value='2'>Envivronmental Action & Resource Center<br>
	<input type='checkbox' name='groups[]' value='3'>Recycling And Rubbish Exhibit<br>
	<input type='checkbox' name='groups[]' value='4'>Green Campus Program<br>
	<div class='cont_header'>Involvement Type</div>
	<input type='checkbox' name='groups[]' value='5'> Paid<br>
	<input type='checkbox' name='groups[]' value='6'> Volunteer<br>
	<input type='checkbox' name='groups[]' value='7'> Internship<br>
	<input type='submit' value='Create'> <input type='reset' value='Clear'>
	</form>";
}

//display preview of new event details
elseif($action=='create_event2') {
	include 'mysql_settings.php';
	//retrieve variables from POST
	$name=$_POST['name'];
	$date_month=$_POST['date_month'];
	$date_day=$_POST['date_day'];
	$date_year=$_POST['date_year'];
	$start_hour=$_POST['start_hour'];
	$start_min=$_POST['start_min'];
	$start_ampm=$_POST['start_ampm'];
	$end_hour=$_POST['end_hour'];
	$end_min=$_POST['end_min'];
	$end_ampm=$_POST['end_ampm'];
	$contact1=$_POST['contact1'];
	$contact2=$_POST['contact2'];
	$address=$_POST['address'];
	$description=$_POST['description'];
	$months=listMonths();	
	
echo "<center>The following event will be added to the database. Click Create Event to continue.
	<form action='$index_file?action=create_event3' method='post'>
	<input type='submit' value='Create Event' />
	<input type='hidden' name='name' value='$name' />
	<input type='hidden' name='date_month' value='$date_month' />
	<input type='hidden' name='date_day' value='$date_day' />
	<input type='hidden' name='date_year' value='$date_year' />
	
	<input type='hidden' name='start_hour' value='$start_hour' />
	<input type='hidden' name='start_min' value='$start_min' />
	<input type='hidden' name='start_ampm' value='$start_ampm' />
	<input type='hidden' name='end_hour' value='$end_hour' />
	<input type='hidden' name='end_min' value='$end_min' />
	<input type='hidden' name='end_ampm' value='$end_ampm' />
	<input type='hidden' name='contact1' value='$contact1' />
	<input type='hidden' name='contact2' value='$contact2' />
	<input type='hidden' name='address' value='$address' />
	<input type='hidden' name='description' value='$description' />
	</center>
	<div class='cont_header'>Event Details</div>
	<b>Name:</b> $name<br>
	<b>Date:</b> $months[$date_month] $date_day, $date_year <br>
	<b>Start Time:</b> $start_hour:$start_min $start_ampm<br>
	<b>End Time:</b> $end_hour:$end_min $end_ampm<br>
	<b>Primary Contact:</b> $contact1<br>
	<b>Secondary Contact:</b> $contact2<br>
	<b>Address:</b> $address<br>
	<b>Description:</b> $description<br>
	<div class='cont_header'>Event Interest and Involvement</div>";
	if(!isset($_POST['groups'])) echo "None selected";
	foreach ($_POST['groups'] as $value) {
		echo "<input type='hidden' name='groups[]' value='$value' />";
		$sql = "SELECT gtype FROM groups WHERE gnum='$value'";
		$result = mysql_query($sql);
		//retrieving gtypes from groups based on gnump in array passed by POST
		while ($row = mysql_fetch_array($result)) {
			echo $row['gtype'] . "<br>";
		}
	}
	echo "</form>";
}

//display confirmation and process sql statements
elseif($action=='create_event3') {
	include 'mysql_settings.php';
	$name=$_POST['name'];
	$date_month=$_POST['date_month'];
	$date_day=$_POST['date_day'];
	$date_year=$_POST['date_year'];
	$start_hour=$_POST['start_hour'];
	$start_min=$_POST['start_min'];
	$start_ampm=$_POST['start_ampm'];
	$end_hour=$_POST['end_hour'];
	$end_min=$_POST['end_min'];
	$end_ampm=$_POST['end_ampm'];
	$contact1=$_POST['contact1'];
	$contact2=$_POST['contact2'];
	$address=$_POST['address'];
	$description=$_POST['description'];
	$months=listMonths();

	//converting date to MYSQL format
	$date="$date_year-$date_month-$date_day";
	
	//converting time format to 24hour
	$start_time=timeConvert('24',$start_hour,$start_min,$start_ampm);
	$end_time=timeConvert('24',$end_hour,$end_min,$end_ampm);
	
	//insert into events
	
	//protection against mysql injection
	$name = stripslashes($name);
	$name = mysql_real_escape_string($name);
	$date = stripslashes($date);
	$date = mysql_real_escape_string($date);
	$start_time = stripslashes($start_time);
	$start_time = mysql_real_escape_string($start_time);
	$end_time = stripslashes($end_time);
	$end_time = mysql_real_escape_string($end_time);
	$contact1 = stripslashes($contact1);
	$contact1 = mysql_real_escape_string($contact1);
	$contact2 = stripslashes($contact2);
	$contact2 = mysql_real_escape_string($contact2);
	$address = stripslashes($address);
	$address = mysql_real_escape_string($address);
	$description = stripslashes($description);
	$description = mysql_real_escape_string($description);
	
	//now that the data has been sanitized, lets inject it into the database...

	$sql = "INSERT INTO events (name,date,start_time,end_time,contact1,contact2,address,description)
		VALUES ('$name','$date','$start_time','$end_time','$contact1','$contact2','$address','$description')";
	$result = mysql_query($sql);
	if(!$result) {
		die('Insert events Error: ' . mysql_error());
	}
	
	//insert into involved_in
	foreach($_POST['groups'] as $value) {
		//value = gnum
		//protection against mysql injection
		$value = stripslashes($value);
		$value = mysql_real_escape_string($value);

		$sql = "INSERT INTO involved_in (date,name,start_time,gnum)
			VALUES ('$date','$name','$start_time','$value')";
		$result = mysql_query($sql);
		if(!$result) {
			die('Insert involved_in Error: ' . mysql_error());
		}
	}

	//display confirmation
	echo "<center>successfully added event</center>";
}
