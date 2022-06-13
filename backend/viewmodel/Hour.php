<?php
class Hour {
	var $hour;
	var $type;

	// $hour = (string)'9:00' or (int)9
	// !!! $type = 'available' or 'peak'
   // $type = true or false
	function __construct($minutes, $type) {
		$this->setHour($minutes); // in minutes
		$this->type = $type;
	}

	function setHour($minutes) {
		$minutesInHour= $minutes % 60;
		$hour = ($minutes - $minutesInHour) / 60;

		//right representation of minutes: '9:0' -> '9:00'
		if($minutesInHour == 0) {
			$minutesInHour = '00';
		}

		$this->hour = $hour . ":" . $minutesInHour;
	}

	//$hour = (string)'9:00' or (int)9*60
	// function setMinutes($minutes) {
	// 	if(gettype($minutes) == 'string') 
	// 	{
	// 		$time = explode(":", $minutes);
	// 		$this->minutes = intval($time[0])*60 + intval($time[1]);
	// 	} 

	// 	elseif(gettype($minutes) == 'integer') 
	// 	{
	// 		$this->minutes = $minutes;
	// 	}
	// }

	//param = 'int' / 'string'
	// function getTime($param) {
	// 	if($param == 'string') 
	// 	{
	// 		$minutesInHour= $this->minutes % 60;
	// 		$hour = ($this->minutes - $minutesInHour) / 60;

	// 		//right representation of minutes: '9:0' -> '9:00'
	// 		if($minutesInHour == 0) {
	// 			$minutesInHour = '00';
	// 		}

	// 		return $hour . ":" . $minutesInHour;
	// 	}
	// }
}

?>