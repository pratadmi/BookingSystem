<?php





/*require dirname(__DIR__).'../viewmodel/Day.php';

require dirname(__DIR__).'../viewmodel/Service.php';

require dirname(__DIR__).'../logic/Authorize.php';

require dirname(__DIR__).'../logic/Calendar.php';

require dirname(__DIR__).'../logic/Mail.php';*/

require dirname(__DIR__).'/repository/Repository.php';

require dirname(__DIR__).'/logic/Authorize.php';

require dirname(__DIR__).'/logic/Calendar.php';



$rep = new Repository();
//var_dump($rep);

//echo var_dump($_POST);

//array(4) { ["startDay"]=> string(10) "2018-10-18" ["startTime"]=> string(2) "15" ["endTime"]=> string(2) "17" ["days"]=> string(1) "2" }


//$roomsArr = $_POST["rooms"];

//var_dump($roomsArr);
$daysofweek = $_POST["daysofweek"];

//var_dump($daysofweek);
$roomsArr = $_POST["rooms"];
var_dump($daysofweek);

$rooms = 4;
/*$roomsFromDB = $rep->get_stations_number();
var_dump($roomsFromDB);*/
// $startDay âñåãäà ïîíåäåëüíè





for ($d=1; $d <= 7; $d++){

      if ($daysofweek[$d] === NULL) $daysofweek[$d] = false;

      else $daysofweek[$d] = true;

}

echo "<br>";
var_dump($daysofweek);

$startDay = "";
$startTime = "";
$endDay = "";
$endTime = "";


$dates  = $_POST["dates"];
$dates = explode(" - ", $dates);
$start = explode(" ", $dates[0]);
#$end = explode(" ", date("Y-m-d H:i", strtotime($dates[1]." +1 hour")));
#$end = explode(" ", date("Y-m-d H:i", strtotime($dates[1]." +1 hour")));
$end = explode(" ", $dates[1]);

$startDay = strtotime($start[0]);
$startTime = $start[1];
$endDay = strtotime($end[0]);
$endTime = $end[1];


echo $startDay." start day <br>";


echo $startTime." start time <br>";
#exit;


echo $endDay." endDay <br>";


echo $endTime." EndTeims <br>";

$days = abs(($startDay - $endDay)/(60*60*24));
$hours = abs((strtotime($endTime)-strtotime($startTime))/(60*60));

echo $hours." HOURS <br>";



/*
$startTime = $_POST["startTime"];

$endTime = $_POST["endTime"];

$days = $_POST["days"];*/

$message = $_POST["message"];
$stations = $_POST["stations"];
$blockWeekends = $_POST["weekends"]; //sends "on" when checked
$service = $_POST["services"];


$period = new DatePeriod(
     new DateTime($dates[0]),
     new DateInterval('P1D'),
     new DateTime($dates[1])
);

echo "<br>";
var_dump($period);


if($period)
{
	echo "<br>Period HERE";
	foreach($period as $key => $value)
	{
		echo "<br>Period key - ".$key;
		$curDayOfWeek = $value->format('N');
		echo "<br>CurdayOfweek - ".$curDayOfWeek;
		if (!$daysofweek[$curDayOfWeek]) {
			echo "<br>dayofweek ".$daysofweek[$curDayOfWeek];
			continue;
		}

#		$periodt = new DatePeriod(new DateTime($startTime),new DateInterval('PT1H'),new DateTime($endTime));
		$periodt = new DatePeriod(new DateTime($value->format('Y-m-d')." {$startTime}"),new DateInterval('PT1H'),new DateTime($value->format('Y-m-d')." {$endTime}"));

		foreach($periodt as $valuet)
		{
			for($room=1; $room <= $rooms; $room++)
			{
				if($room==4)
				{
					continue;
				}

				$gsn = $rep->get_stations_number($room);

				if(isset($gsn[0]->stations) AND $gsn[0]->stations < $roomsArr[$room])
				{
					echo "event added ".$value->format('Y-m-d')." date ". $valuet->format('H:i:s'). " time ". $room. "<- room ". $roomsArr[$room]. "<- stations <br>\r\n";
					$rep->insertEvent($value->format('Y-m-d'), $valuet->format('H:i:s'), $room, $roomsArr[$room], $message);
				}
			}
		}
	}
}
#exit;




$end = explode(" ", $dates[1]);

$endTime = date("H:i", strtotime($end[1]." +15 minutes"));

#$endTime = $end[1];


$period = new DatePeriod(
     new DateTime($dates[0]),
     new DateInterval('P1D'),
     new DateTime($dates[1])
);


if($period)
{
	foreach($period as $key => $value)
	{
		$curDayOfWeek = $value->format('N');
		if (!$daysofweek[$curDayOfWeek]) continue;

#		$periodt = new DatePeriod(new DateTime($startTime),new DateInterval('PT15M'),new DateTime($endTime));
		$periodt = new DatePeriod(new DateTime($value->format('Y-m-d')." {$startTime}"),new DateInterval('PT15M'),new DateTime($value->format('Y-m-d')." {$endTime}"));
		$room = 4;

		foreach($periodt as $valuet)
		{
			$gsn = $rep->get_stations_number($room);

			if(isset($gsn[0]->stations) AND $gsn[0]->stations > $roomsArr[$room])
			{
#					echo "it's room 4 = virtualizer <br>";
				echo "event added ".$value->format('Y-m-d')." date ". $valuet->format('H:i:s'). " time ". $room. "<- room ". $roomsArr[$room]. "<- stations <br>\r\n";
				$rep->insertEvent($value->format('Y-m-d'), $valuet->format('H:i:s'), $room, $roomsArr[$room], $message);
			}
		}
	}
}




#echo "444";
/*
for ($day=0; $day <= $days ; $day++)
{
#echo $day;
	$curDayOfWeek = date("N",strtotime($startday."+".$day."days"));
	$curDate = date("Y-m-d",strtotime($startday."+".$day."days"));

echo  "L:{$curDayOfWeek}H:{$curDate}\r\n";


	if (!$daysofweek[$curDayOfWeek]) continue; //if not day that was choosen than break it, else thats right
	for ($room=1; $room <= $rooms; $room++) {
		//if room4
		if ($room==4) {
			echo "it's room 4 = virtualizer <br>";
#			var_dump($rep);
#			createEventVirt($curDate, $startTime, $hours, $room, $roomsArr[$room], $message,$rep);
			continue;
		}
		for ($hour=0; $hour < $hours; $hour++) {

			createEvent($curDate, $startTime+$hour, $room, $roomsArr[$room], $message,$rep);
		}
	}
}*/



/*$date=date_create("2018-10-18");

date_add("2018-10-18",date_interval_create_from_date_string("14 days"));



echo $startDay;

$curDate=date_create($startDay);

echo date('w', strtotime($startDay));

*/



//echo "string";

/*

if ($service != "Virtualizer") {

	# code...

	$allhours = $endTime-$startTime;

   for ($week=0; $week < $weeks; $week++)

   for ($d=1; $d <= 7; $d++){

      if (!$daysofweek[$d]) continue;

      $day = $startDay+$week*7+$d-1;



		$curDate=date_create($startDay);

		date_add($curDate,date_interval_create_from_date_string($day." days"));

		echo "</br>".date_format($curDate,"Y-m-d")."</br>";

		$data_calendar = array('id' => uniqid(),

 					  'summary' => $stations." STATION(s) closed for ".$message,

 					  'colorId' => 8,

					  'description' => $message,

 					  'start_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $startTime.":00")),

 					  'end_datetime' => date('c', strtotime(date_format($curDate,"Y-m-d") . ' ' . $endTime.":00")));

		//$google_client = new Authorize("info@torchvr.cz");

					//$calendar = new Calendar($google_client->client, "info@torchvr.cz");

					//$calendar->addEvent($data_calendar);

		//echo "</br> day ".$day;

		for ($hours=0; $hours < $allhours; $hours++) {

			//echo " ".$startTime+$hours.":00:00 ";

			$time = $startTime+$hours.":00:00";

			//echo $time;

			$lol = insertReservation(date_format($curDate,"Y-m-d"), $time, $stations, 0, 'ClosedByAdmin', 'Cosmos', 'CZK', 'CLOSED', $message, "1,2,3,4");

			echo $lol;

		}



	}

	return;

//echo "                   ";

//echo $endTime-$startTime;

}*/

/*

for ($week=0; $week < $weeks; $week++){

   for ($d=1; $d <= 7; $d++){

      if (!$daysofweek[$d]) continue;

      $day = $startDay+$week*7+$d-1;



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

			//$google_client = new Authorize("info@torchvr.cz");

			//		$calendar = new Calendar($google_client->client, "info@torchvr.cz");

			//		$calendar->addEvent($data_calendar);

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

				$lol = insertReservation(date_format($curDate,"Y-m-d"), $time, 1, 0, 'ClosedByAdmin', 'Virtualizer', 'CZK', 'CLOSED', $message, '1,2,3,4');

				echo $lol;

			}

		}



	}


}*/


		/*try {

			$db = $this->getConnection();

			$stmt = $db->prepare($sql);

			$stmt->bindParam('date', $date);

			$stmt->bindParam('time', $time);

			$stmt->bindParam('people', $people);

			$stmt->bindParam('total_cost', $total_cost);

			$stmt->bindParam('email', $email);

			$stmt->bindParam('game_name', $game_name);

			$stmt->bindParam('langname', $langname);

			$stmt->bindParam('unique_id', $unique_id);

			$stmt->bindParam('voucher', $voucher);

         $stmt->bindParam('rooms', $rooms);

			$status = $stmt->execute();

			$db = null;

			return $status;

		} catch(PDOException $e) {

			return $e->getMessage();

		}*/









//$rep->insertReservation('2018-12-12', '14:00:00', 2, 1000, 'mail', 'Cosmos', 'CZK', '100881', '161651');





?>