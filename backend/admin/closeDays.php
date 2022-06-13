<?php


/*require dirname(__DIR__).'../viewmodel/Day.php';
require dirname(__DIR__).'../viewmodel/Service.php';
require dirname(__DIR__).'../logic/Authorize.php';
require dirname(__DIR__).'../logic/Calendar.php';
require dirname(__DIR__).'../logic/Mail.php';*/
require '../repository/Repository.php';
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';

$rep = new Repository();
//echo var_dump($_POST);
//array(4) { ["startDay"]=> string(10) "2018-10-18" ["startTime"]=> string(2) "15" ["endTime"]=> string(2) "17" ["days"]=> string(1) "2" }

$startDay = $_POST["startDay"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$days = $_POST["days"];
$message = $_POST["message"];
$stations = $_POST["stations"];
$blockWeekends = $_POST["weekends"]; //sends "on" when checked
$service = $_POST["services"];

/*$date=date_create("2018-10-18");
date_add("2018-10-18",date_interval_create_from_date_string("14 days"));
echo date_format($date,"Y-m-d");*/

/*echo $startDay." day  time ";
echo $startTime;
echo $endTime;
echo $days;*/
echo $startDay;
$curDate=date_create($startDay);
echo date('w', strtotime($startDay));


//echo "string";/*

if ($service != "Virtualizer") {
	# code...
	$allhours = $endTime-$startTime;
	for ($day=0; $day < $days; $day++) { 
		/*if ($blockWeekends == "on") {
			echo "LOOOOOOOOOOOOL ONO ON";
		}*/
		$curDate=date_create($startDay);
		date_add($curDate,date_interval_create_from_date_string($day." days"));
		echo "</br>".date_format($curDate,"Y-m-d")."</br>";
		$data_calendar = array('id' => uniqid(),
 					  'summary' => $stations." STATION(s) closed for ".$message,
 					  'colorId' => 8,
					  'description' => $message,
 					  'start_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $startTime.":00")),
 					  'end_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $endTime.":00")));
		$google_client = new Authorize("info@torchvr.cz");
					$calendar = new Calendar($google_client->client, "info@torchvr.cz");
					$calendar->addEvent($data_calendar);
		//echo "</br> day ".$day;
		for ($hours=0; $hours < $allhours; $hours++) { 
			//echo " ".$startTime+$hours.":00:00 ";
			$time = $startTime+$hours.":00:00";
			//echo $time;
			$lol = $rep->insertReservation(date_format($curDate,"Y-m-d"), $time, $stations, 0, 'ClosedByAdmin', 'Cosmos', 'CZK', 'CLOSED', $message);
			echo $lol;
		}

	}
	return;
//echo "                   ";
//echo $endTime-$startTime;
}

for ($day=0; $day < $days; $day++) { 
		/*if ($blockWeekends == "on") {
			echo "LOOOOOOOOOOOOL ONO ON";
		}*/
		$allhours = $endTime-$startTime;
		$curDate=date_create($startDay);
		date_add($curDate,date_interval_create_from_date_string($day." days"));
		echo "</br>".date_format($curDate,"Y-m-d")."</br>";
		$data_calendar = array('id' => uniqid(),
 					  'summary' => $stations." STATION(s) closed for ".$message,
 					  'colorId' => 8,
					  'description' => $message,
 					  'start_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $startTime.":00")),
 					  'end_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $endTime.":00")));
			$google_client = new Authorize("info@torchvr.cz");
					$calendar = new Calendar($google_client->client, "info@torchvr.cz");
					$calendar->addEvent($data_calendar);
		//echo "</br> day ".$day;
		for ($hours=0; $hours < $endTime-$startTime; $hours++) { 
			$minutes = 0;
			

			for ($quarter=0; $quarter < 4 ; $quarter++) { 
				# code...
				
				//echo " ".$startTime+$hours.":00:00 ";
				
				if ($quarter==0) {
					$minutes = "00";
				}
				else{
					$minutes=$quarter*15;
				}
				$time = $startTime+$hours.":".$minutes.":00";
				//echo $time;
				//echo $time;
				$lol = $rep->insertReservation(date_format($curDate,"Y-m-d"), $time, 1, 0, 'ClosedByAdmin', 'Virtualizer', 'CZK', 'CLOSED', $message);
				echo $lol;
			}
			return;
		}

	}



//$rep->insertReservation('2018-12-12', '14:00:00', 2, 1000, 'mail', 'Cosmos', 'CZK', '100881', '161651');


?>