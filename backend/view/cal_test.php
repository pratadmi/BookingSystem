<?php
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';
require dirname(__DIR__).'/repository/Repository.php';

cal_test();

function cal_test() {
	$rep = new Repository();

	$internalInfo = $rep->getInternalInfo();

	$google_id = (string)$internalInfo->google_id;
	$timezone = (string)$internalInfo->timezone;

	//timezone for generate date
	date_default_timezone_set($timezone);

	// add event to google calendar
 	$google_client = new Authorize($google_id);
 	$calendar = new Calendar($google_client->client, $google_id);
 	//$calendar->addEvent($data_calendar);

	//$results = $calendar->getListEvents('2018-07-26');
	$results = $calendar->deleteEvent('f706ff49cb');

	echo var_dump($results);
}

?>