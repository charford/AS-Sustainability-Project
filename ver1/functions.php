<?php
	//this file will be used to store functions which are accessed
	//throughout the program

	function VisitorIP() {
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
			else $TheIp=$_SERVER['REMOTE_ADDR'];

		return trim($TheIp);
	}
	
	//timeConvert function by Casey	
	//conv_to = convert to, 24 hour or 12?
	//conv_time = time to convert
	//example call: 
	//	timeConvert('24','7','15','pm');
	//	returns: 19:15:00
	//	doesn't do seconds, but that is not necessary right now

	function timeConvert($conv_to,$conv_hour,$conv_min,$conv_ampm) {
		if($conv_to=='24') {
			if($conv_ampm=='pm') {
				if($conv_hour<12) $conv_hour=$conv_hour+12;
			}
			if($conv_hour<10) $conv_hour="0" . $conv_hour;
			return $conv_hour.":".$conv_min.":00";
		}
		elseif($conv_to=='12') {
			if($conv_hour>12) {
				$conv_hour=$conv_hour-12;
				if($conv_hour<10) $conv_hour="0" . $conv_hour;
				return $conv_hour.":".$conv_min." pm";	
			}
			return $conv_hour.":".$conv_min." am";	
		}
	}
	function listMonths() {
		$months=array (
		1=>January,
		2=>February,
		3=>March,
		4=>April,
		5=>May,
		6=>June,
		7=>July,
		8=>August,
		9=>September,
		10=>October,
		11=>November,
		12=>December );
	return $months;
	}

?>
