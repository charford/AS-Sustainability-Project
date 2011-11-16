<?php

//forms to satisfy phase 1....no real code yet

echo "
<center>Select the type of statistics to include in the report, then click Generate Report.</center>
<div class='cont_header'>Statistics</div>
<form action='$index_file?action=event_stats2' method='post'>
<input type='checkbox' name='total_rsvp'> Total RSVP of Past Events, by Event<br>
<input type='checkbox' name='num_volunteers'> Total number of people interested in volunteering.<br>
<input type='checkbox' name='num_interns'> Total number of people interested in internships.<br>	
<input type='checkbox' name='num_paid'> Total number of people interested in paid positions.<br>	
<input type='checkbox' name='num_asrp'> Total number of people interested in AS Recycling Events<br>	
<input type='checkbox' name='num_assp'> Total number of people interested in AS Sustainability Events<br>	
<input type='checkbox' name='num_earc'> Total number of people interested in Environmental Action & Resource Center Events<br>	
<input type='checkbox' name='num_rare'> Total number of people interested in Recycling And Rubbish Exhibit Events<br>	
<input type='checkbox' name='num_gcp'> Total number of people interested in Green Campus Program Events Events<br>
<input type='submit' value='Generate Report' /> <input type='reset' value='Reset' />
</form>";


//not even close to being finished :(
/*
function getRows($table,$where) {
$sql = "SELECT COUNT(*) FROM interested_in WHERE gnum='6'";
$total = mysql_query($sql);
$total = mysql_fetch_array($total);
echo "The total ".$total[0];
return $total[0];
}
$num_paid=getRows('interested_in',"gnum='5'");
//$num_paid=getRows('interested_in',5);

echo $num_paid;
$perc_paid = $num_paid/($num_paid+$num_volunteer+$num_intern);
$perc_paid *= 100;
$perc_volunteer = $num_volunteer/($num_paid+$num_volunteer+$num_intern);
$perc_volunteer *= 100;
$perc_intern = $num_intern/($num_paid+$num_volunteer+$num_intern);
$perc_intern *= 100;
echo "
<img src='https://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World'>";
*/
?>
