<?php
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';
require dirname(__DIR__).'/repository/Repository.php';

synchronize('July');

function synchronize($month) {
	$rep = new Repository();

	$internalInfo = $rep->getInternalInfo();

	$google_id = (string)$internalInfo->google_id;
	$timezone = (string)$internalInfo->timezone;

	//timezone for generate date
	date_default_timezone_set($timezone);

	//$input = 'January' -> $date = '2018-01-01' 
	$date = date('Y-m-d', strtotime($month . ' 1'));

	$data = $rep->getDataToSynchronize($date);
	
	echo var_dump($data);

	$end_time = getTime(getMinutes($data->time) + $data->duration);

	$summary = $data->firstname . ' ' . $data->lastname . ' - ' .
			   $data->people . ' PLAYERS - ' . $data->name . ' (' . $data->langname . ')';

	$description = 'Client: <b>'.$data->firstname.' '.$data->lastname.'</b><br>'.
				   'Phone: <b>'.$data->phone.'</b><br>'. 
				   'Email: <b>'.$data->email.'</b><br>'. 
				   'Players: <b>'.$data->people.' PLAYERS</b><br>'.
				   'Voucher: <b>'.($data->voucher == 'true' ? 'Yes' : 'No').'</b><br>'.
				   'Unique code: <b>'.$data->unique_id.'</b>';

	$data_calendar = array('id' => $data->unique_id,
						  'summary' => $summary,
						  'description' => $description,
						  'start_datetime' => date('c', strtotime($data->date . ' ' . $data->time)),
						  'end_datetime' => date('c', strtotime($data->date . ' ' . $end_time)));

	// add event to google calendar
 	$google_client = new Authorize($google_id);
 	$calendar = new Calendar($google_client->client, $google_id);

 	try {
 		//$event = $calendar->getEvent('151d9c208a');
 		//echo var_dump($event->getSummary());
 		$res = $calendar->addEvent($data_calendar);
 		echo $res;
 		// $res = $calendar->deleteEvent($data->unique_id);
 		// echo $res;
 		// $res = $calendar->updateEvent($data->unique_id, $data_calendar);
 		// echo $res;
 	} catch(Google_Service_Exception $e) {
 		echo 'error : ' . $e->getCode();
 	}
}

function getMinutes($time) {
	if(gettype($time) == 'string') {
		$time = explode(':', $time);

		return (int)$time[0]*60 + (int)$time[1] + (int)$time[2] / 60;
	}
}

//param = 'int' / 'string'
function getTime($minutes) {
	$minutesInHour= $minutes % 60;
	$hour = ($minutes - $minutesInHour) / 60;

	//right representation of minutes: '9:0' -> '9:00'
	if($minutesInHour == 0) {
		$minutesInHour = '00';
	}

	return $hour . ":" . $minutesInHour;
}

?>