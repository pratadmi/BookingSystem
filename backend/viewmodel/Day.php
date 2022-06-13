<?php
require __DIR__.'/Hour.php';

class Day {

	var $date;
	var $hours = array();

	function __construct($date) {
		$this->getDate($date);
	}

	function getDate($date) {
		$date = strtotime($date);
		$this->date = date('j F Y', $date);
	}

	// function addHour($hour, $type) {
	// 	$this->hours[] = new Hour($this->getHour($hour), $type);
	// }

	function addHour($minutes, $type) {
		$this->hours[] = new Hour($minutes, $type);
	}

	// function removePeakHours(){
	// 	$availableHours = array();
		
	// 	for($t=0;$t<sizeof($this->hours);$t++) {
	// 		if($this->hours[$t]->type == 'available') {
	// 			$availableHours[] = $this->hours[$t];
	// 		}
	// 	}

	// 	$this->hours = $availableHours;
	// }
}

?>