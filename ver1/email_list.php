<?php
	//based on the user preferences chosen below, an email list will be generated

//the first view, which asks for info
if($action==email_list) {
echo "
<center>
Select the types of events that should be used to create an email list, then click Create.
</center>

<form name='email_list' method='post' action='main.php?action=email_list2'>
<div class='cont_header'>Interest Type</div>
<input type='checkbox' name='asrp'>AS Recycling Program<br>
<input type='checkbox' name='assp'>AS Sustainability Program<br>
<input type='checkbox' name='earc'>Envivronmental Action & Resource Center<br>
<input type='checkbox' name='rare'>Recycling And Rubbish Exhibit<br>
<input type='checkbox' name='gcp'>Green Campus Program<br>

<div class='cont_header'>Involvement Type</div>
<input type='checkbox' name='paid'> Paid<br>
<input type='checkbox' name='volunteer'> Volunteer<br>
<input type='checkbox' name='internship'> Internship<br>
<input type='submit' value='Create'>
<input type='reset' value='Reset'>
</form>";
}
//after form submission, the below code will generate an email list
elseif($action==email_list2) {
echo "It's magic, keep watching, the list is going to create itself. Not really, but it will once the database is in place.";
}
?>
