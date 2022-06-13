<?php
//require './lib/vendor/autoload.php';

require dirname(__DIR__).'/viewmodel/Day.php';
require dirname(__DIR__).'/viewmodel/Service.php';
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';
require dirname(__DIR__).'/logic/Mail.php';
//require dirname(__DIR__).'/logic/MailTest.php';
require dirname(__DIR__).'/repository/Repository.php';

class Json {

	var $rep;
	var $city;

	function __construct() {
		$this->rep = new Repository();
		$this->city = "Prague";
	}

	////////////////////
	//	GET SERVICES  //
	////////////////////
	function getServices()
	{
		$services = array();

		$s_rep = $this->rep->getServices();

		for($i=0; $i < sizeof($s_rep); $i++) {
			$s = new Service($s_rep[$i]->name,
							 (int)$s_rep[$i]->max_players,
							 (int)$s_rep[$i]->min_players,
							 (int)$s_rep[$i]->duration,
							 (int)$s_rep[$i]->price,
							 $s_rep[$i]->image_preview,
							 $s_rep[$i]->url);

			$s->addLangs($this->rep->getLanguageByNameService($s->name_service));

			$services[] = $s;
		}

		return '{"services":'. json_encode($services) .'}';
	}


	function getServiceByName($service_name) {
		$services = array();

		$s_rep = $this->rep->getServicesByName($service_name);

		for($i=0; $i < sizeof($s_rep); $i++) {
			$s = new Service($s_rep[$i]->name,
							 (int)$s_rep[$i]->max_players,
							 (int)$s_rep[$i]->min_players,
							 (int)$s_rep[$i]->duration,
							 (int)$s_rep[$i]->price,
							 $s_rep[$i]->image_preview,
							 $s_rep[$i]->url);

			$s->addLangs($this->rep->getLanguageByNameService($s->name_service));

			$services[] = $s;
		}

		return '{"services":'. json_encode($services) .'}';
	}



	////////////////////////
	//	GET RESERVATIONS  //
	////////////////////////
	function getReservations($game_name, $amountPlayers, $date_input)
	{
#echo $date_input;exit;
		//some internal info
		$internalInfo = $this->rep->getInternalInfo($this->city);
#var_dump($internalInfo);

		$start		= (int)$internalInfo->openat * 60; //Начало время
		$end		= (int)$internalInfo->closeat * 60; //Конец время
		$period 	= (int)$internalInfo->period;
		$timezone 	= (string)$internalInfo->timezone;

		//some information about service
		$service	= $this->rep->getServiceByName($game_name);
		$max_players	= (int)$service->max_players;
		$min_players 	= (int)$service->min_players;
		$duration 	= (int)$service->duration;
		$url 		= (string)$service->url;

		//timezone for generate date
		date_default_timezone_set($timezone);

		$days = array();



		//construct days array for some period
		for($day=0; $day < $period; $day++)
		{
			//get date
			///NEW!!!!!!!!!
			$date = date('Y-m-d', strtotime($date_input . ' +' . $day.' day'));

			$days[] = new Day($date);

			$step = $this->getIterationStep($game_name);
#var_dump($step);

			//construct time hours for this day
			for($time = $start; ($time+$duration) <= $end; $time += $step)
			{
				$state = $this->isTimeAvailable($date,
								$time,
								$start,
								$end,
								$timezone,
								$game_name,
								$duration,
								$max_players,
								$min_players,
								$amountPlayers
				);

				$days[$day]->addHour($time, $state);
			}
		}

		return '{"games":'. json_encode($days) .'}';
	}

function isTimeAvailable($date, $time, $start, $end, $timezone, $game_name, $duration, $max_players, $min_players,  $amountPlayers) {

$state = $this->isAvailable($date, $time, $start, $end, $timezone, $game_name, $duration, $max_players, $min_players,  $amountPlayers);

if ($state) return 'available';
 else return 'peak';
}


function places($room, $station, $player)
{
$avail = [];
if (!$room) return $avail;
$r0 = -1;
foreach ($room as $r)
   if ($station[$r] >= $player)
      $r0 = $r;
if ($r0 >= 0)
   {
   foreach ($room as $r)
      if ($station[$r] >= $player
       and $station[$r] < $station[$r0])
         $r0 = $r;
   array_push($avail,$r0);
   return $avail;
   }

if (count($room) <= 1) return $avail;
$r1 = -1;
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and
    $station[$r]+$station[$r0] >= $player)
      {
      $r1 = $r0;
      $r2 = $r;
      }
if ($r1 <> -1)
{
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and 
    $station[$r]+$station[$r0] >= $player
    and $station[$r]+$station[$r0] <
    $station[$r1]+$station[$r2])
      {
      $r1 = $r0;
      $r2 = $r;
      }
array_push($avail,$r1);
array_push($avail,$r2);
return $avail;
}

if (count($room) <= 2) return $avail;
$r1 = -1;
foreach ($room as $r00)
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and $r <> $r00 and
    $r0 <> $r00 and
    $station[$r]+$station[$r0] +
    $station[$r00] >= $player)
      {
      $r1 = $r;
      $r2 = $r0;
      $r3 = $r00;
      }
if ($r1 <> -1)
{
foreach ($room as $r00)
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and $r <> $r00 and
    $r0 <> $r00 and
    $station[$r]+$station[$r0]+
    $station[$r00] >= $player
    and $station[$r]+$station[$r0]+
    $station[$r00] < $station[$r1]+
    $station[$r2]+$station[$r3])
      {
      $r1 = $r;
      $r2 = $r0;
      $r3 = $r00;
      }
array_push($avail,$r1);
array_push($avail,$r2);
array_push($avail,$r3);
return $avail;
}

if (count($room) <= 3) return $avail;
$r1 = -1;
foreach ($room as $r000)
foreach ($room as $r00)
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and $r <> $r00 and
    $r <> $r000 and $r0 <> $r00 and
    $r0 <> $r000 and $r00 <> $r000 and
    $station[$r]+$station[$r0]+
    $station[$r00]+$station[$r000] 
    >= $player)
      {
      $r1 = $r;
      $r2 = $r0;
      $r3 = $r00;
      $r4 = $r000;
      }
if ($r1 <> -1)
{
foreach ($room as $r000)
foreach ($room as $r00)
foreach ($room as $r0)
foreach ($room as $r)
   if ($r <> $r0 and $r <> $r00 and
    $r <> $r000 and $r0 <> $r00 and
    $r0 <> $r000 and $r00 <> $r000 and
    $station[$r]+$station[$r0]+
    $station[$r00]+$station[$r000]
    >= $player and
    $station[$r]+$station[$r0]+
    $station[$r00]+$station[$r000]
    < $station[$r1]+$station[$r2]+
    $station[$r3]+$station[$r4])
      {
      $r1 = $r;
      $r2 = $r0;
      $r3 = $r00;
      $r4 = $r000;
      }
array_push($avail,$r1);
array_push($avail,$r2);
array_push($avail,$r3);
array_push($avail,$r4);
return $avail;
}

}

	function CheckEvents($date,$time,$station)
	{
		$h = intdiv($time,60);
		$m = $time-$h*60;

	#echo	$hour = $h . ':' . $m . ':00';
		$hour = $h . ':' . sprintf("%02d", $m) . ':00';



		$ds = $this->rep->get_events($date, $hour);

		foreach ($ds as $id => $s)
		   if ($station[$id] > $s)
		      $station[$id] = $s;
		return $station;
	}


function isAvailable($date, $time, $start, $end, $timezone, $game_name, $duration, $max_players, $min_players,  $amountPlayers) {
// Andrey Demidov
// anrey@bitmessage.ch

$type = $this->rep->getTypeService
 ($game_name)->type;

$service = $this->rep->getServiceByName($game_name);
$licenses = (int)$service->licenses;

//minimal players
if ($amountPlayers < $min_players)
   $amountPlayers = $min_players;

//if old date -> 'peak'
if($date < date('Y-m-d'))
   return false;

//if old hour -> 'peak'
if($date == date('Y-m-d')) 
   {
   $now = $this->getMinutes(date('H:i:s'));
   if($now > $time) 
      return false;
   }

//if hour not be in open hours -> 'peak'
if($time+$duration < $start || $time+$duration > $end) 
   return false;


$busy_room = [];

// adding current group
$gr = [$amountPlayers];

// adding all groups from database in request time
$reservations = $this->rep->
 get_day($date);
 
foreach ($reservations as $res)
   {
   $t = $this->getMinutes
    ((string) $res->time);
   $dt = (int)$res->duration;
   $people = (int)$res->people;
   if ($t > $time and
    $t < $time+$duration or 
    $t+$dt > $time and 
    $t+$dt < $time+$duration or
    $t <= $time and 
    $t+$dt >= $time+$duration)
      {
      if ($res->name == $game_name)
         array_push($gr,$people);
      $busy = explode(',', $res->rooms);
      foreach ($busy as $b)
         array_push($busy_room, $b);
      }
   }

// number of players do not exceed max_players
if ($amountPlayers > $max_players)
   return false;

// number of players do not exceed licenses

$players = 0;
foreach ($gr as $p)
   $players+= $p;
if ($players > $licenses)   
   return false;

$val = $this->rep->get_id_type();

foreach ($val as $id)
   if ($id->type == $type)
      $type_id = $id->id;


$val = $this->rep->get_id_stations();

$station = [];
$free_room = [];
foreach ($val as $id)
   {
   $station[$id->id] = $id->stations;
   $find = false;
   foreach ($busy_room as $r)
      if ($r == $id->id)
         $find = true;
   if (!$find) 
      array_push($free_room, $id->id);
   }

$station = 
 $this->CheckEvents($date,$time,$station);

$val = $this->rep->get_typeid_roomid();

$free_val = [];
foreach ($free_room as $r)
   foreach ($val as $id)
      if ($id->room_id == $r)
         array_push($free_val, $id);

$all_room = [];
foreach ($free_val as $id)
   if ($id->service_type_id == $type_id)
      array_push($all_room, 
       $id->room_id);

$unique_room = [];
foreach ($all_room as $r)
   {
   $find = false;
   foreach ($free_val as $id)
      if ($id->room_id == $r 
      && $id->service_type_id != $type_id)
         {
         $find = true;
         break;
         }
   if (!$find)
      array_push($unique_room,$r);
   }


if (!$all_room) return false;

$avail = $this->places($unique_room,
 $station, $amountPlayers);
if ($avail) return $avail;

return $this->places($all_room,
 $station, $amountPlayers);
}

function name_room($room,$b)
{
sort($room);
$cap = '';
$name = $this->rep->get_names();
foreach ($room as $r)
   {
   if ($cap) $cap.= ', ';
   $cap.= $name[$r];
   }
if ($b)
   $cap = 'Rooms: <b>' . $cap .'</b>';
else
   $cap = 'Rooms: ' . $cap;
return $cap;
}


	function getArrayReservationsForDay($date, $start, $end, $timezone, $game_name) {
		//get iteration step
		$step = $this->getIterationStep($game_name);

		//get type of game
		$type_game = $this->rep->getTypeService($game_name)->type;

		//get array of objects - reservations
		$reservations = $this->rep->getReservationsForDay($date, $type_game);

		//create array of working hours for $day
		$peopleForEachHour = $this->getWorkingHoursArray($start, $end, $step);

		///NEW!!!!!!!!
		$peopleForThatGame = $this->getWorkingHoursArray($start, $end, $step);

		//if we have reservations for $day then add amount of people for each hour
		if(isset($reservations)) {
			//iterate through reservations
			for($i=0; $i < sizeof($reservations); $i++) {
				$time = $this->getMinutes((string)$reservations[$i]->time);
				$people = (int)$reservations[$i]->people;
				$duration = (int)$reservations[$i]->duration;

				///NEW!!!!!!!!!!
				$name = (string)$reservations[$i]->name;

				for($minutes=0; $minutes < $duration; $minutes += $step) {
					$peopleForEachHour[$time+$minutes] += $people;

					///NEW
					if($game_name == $name) {
						$peopleForThatGame[$time+$minutes] += $people;
					}
				}
			}
		}

		///NEW!!!!!!!!!!
		return array('peopleForEachHour' => $peopleForEachHour,
					 'peopleForThatGame' => $peopleForThatGame);
	}

	function getWorkingHoursArray($start, $end, $step) {
		$workingHours = array();

		for($hour = $start; $hour <= $end; $hour += $step)
		{
			$workingHours[$hour] = 0;
		}

		return $workingHours;
	}

	function getMinutes($time) {
		if(gettype($time) == 'string') {
			$time = explode(':', $time);

			return (int)$time[0]*60 + (int)$time[1] + (int)$time[2] / 60;
		}
	}

	function getMinutesL($time) {
		if(gettype($time) == 'string') {
			$time = explode(':', $time);

			return (int)$time[0]*60 + (int)$time[1];
		}
	}

	function getIterationStep($game_name) {
		//get some information about this service
		$service = $this->rep->getServiceByName($game_name);
		$duration = (int)$service->duration;

		if($duration >= 60) {
			$step = 60;
		} elseif($duration < 60) {
			$step = $duration;
		}

		return $step;
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

	////////////////////////
	//	SAVE RESERVATION  //
	////////////////////////
	function saveReservation($data) {
		//data from client
		$contactinfo = json_decode($data['contactinfo']);
		$reservation = json_decode($data['reservation']);

		//some internal info
		$internalInfo = $this->rep->getInternalInfo($this->city);
		$bkcode = $reservation->bkcode;
		$address = (string)$internalInfo->address;
		$google_id = (string)$internalInfo->google_id;
		$start = (int)$internalInfo->openat * 60;
		$end = (int)$internalInfo->closeat * 60;
		$timezone = (string)$internalInfo->timezone;

		//timezone for generate date
		date_default_timezone_set($timezone);

		//some information about service
		$service = $this->rep->getServiceByName($reservation->game_name);
		$max_players=(int)$service->max_players;
		$min_players =(int)$service->min_players;
		$duration = (int)$service->duration;


		//voucher info
		//DON'T FORGET TO CHANGE IT LATER

		$voucher = $reservation->voucher;
		if($bkcode == 'TP')$voucher="solve"; //if it from TP website, so voucher is SOLVE
		if($bkcode == 'TPVRT')$voucher="solvevrt"; //if it from TP website, so voucher is SOLVE
		$voucherGroup = $this->rep->getGroupByVoucherCode($voucher); //array has final [price], [color] of calendar, [code] game code
		$voucherPrice = (int)$voucherGroup->price;

		$total_cost = ($voucherPrice > 0 ? $voucherPrice*(int)$reservation->people : (int)$reservation->total_cost); //if voucherPrice has no final price (<0) then use normal price, otherwise use voucherGroup price
		$suffix = (string)$voucherGroup->code;
		$prefix = (string)$voucherGroup->prefix;

		$calColor = (string)$voucherGroup->color;



		//view game_name
		$game_name = str_replace('_', ' ', $reservation->game_name);

		//check if contact exists
		$emailFromDb = $this->rep->isContactExist($contactinfo->email);
		//if not exists create new one
		if($emailFromDb == NULL) {
			//return true/false if insert is success
			$status_contactinfo = $this->rep->insertContactInfo($contactinfo->firstname, $contactinfo->lastname, $contactinfo->email, $contactinfo->phone);
		} else {
			//already in DB
			$status_contactinfo = true;
		}

		//if inserting contactinfo is success then insert reservation
		if($status_contactinfo == true) {
			$date = date('Y-m-d', strtotime($reservation->date));
			$time = $reservation->time;
			$lang = $this->getLang($reservation->lang_name);

			//check if reservation is still available
			$state = $this->isAvailable($date,
											$this->getMinutes($time),
											$start,
											$end,
											$timezone,
											$reservation->game_name,
											$duration,
											$max_players,
											$min_players,
											(int)$reservation->people
											);

			if($state)
			{
				$now = DateTime::createFromFormat('U.u', microtime(true));
				$unique_id = $this->crypt_unique($now->format("m-d-Y H:i:s.u").''.$contactinfo->email);




				if($voucher == '') {
					$voucher = '&mdash;&emsp;';
				}
				else{
					$this->rep->addUsed($voucher);
				}


				$status_reservation = $this->rep->insertReservation($date, $time, $reservation->people, $total_cost, $contactinfo->email, $reservation->game_name, $lang, $unique_id, $voucher, $state);




				if($status_reservation == true) {
					$delete_link = 'https://'.$_SERVER['HTTP_HOST'].'/booking/delete.html?reserv='.$unique_id.'&lang='.$lang;

					$summary = $prefix.' - '.$total_cost .' Kč - ' . $reservation->people . ' ' . $lang . ' '. $suffix.' ' . $game_name .' '. $this->name_room($state,false) .' '. $contactinfo->firstname . ' ' . $contactinfo->lastname;

					//$summary = $contactinfo->firstname . ' ' . $contactinfo->lastname . ' - ' .
					//		   $reservation->people . ' PLAYERS - ' . $game_name . ' (' . $lang . ')';

					$description = 'Client: <b>'.$contactinfo->firstname.' '.$contactinfo->lastname.'</b><br>'.
								   'Phone: <b>'.$contactinfo->phone.'</b><br>'.
								   'Email: <b>'.$contactinfo->email.'</b><br>'.
								   'Players: <b>'.$reservation->people.' PLAYERS</b><br>'.
									$this->name_room($state,true).'<br>'.
								   'Voucher: <b>'.$voucher.'</b><br>'.
								   '<i>NO NEED to check voucher just charge '.$total_cost.' Kč</i><br>'.
								   'Unique code: <b>'.$unique_id.'</b><br>'.
								   'Delete link: <b>'.$delete_link.'</b><br>'.
								   'Created: <b>'.$now->format("d.m.Y H:i:s").'</b>';

					$end_time = $this->getTime($this->getMinutes($time) + $duration);

					$data_calendar = array(
								  'id' => $unique_id,
								  'colorId' => $calColor,
								  'summary' => $summary,
								  'description' => $description,
								  'start_datetime' => date('c', strtotime($date . ' ' . $time)),
								  'end_datetime' => date('c', strtotime($date . ' ' . $end_time))
								);

					$data_mail = array('email_client' => $contactinfo->email,
									   'name_client' => $contactinfo->firstname.' '.$contactinfo->lastname,
									   'delete_link' => $delete_link);
					//add some data
					$data_mail['game_name'] = $game_name;
					$data_mail['lang'] = $lang;
					$data_mail['players'] = $reservation->people;
					$data_mail['date_mail'] = date('d.m.Y', strtotime($reservation->date));
					$data_mail['time_mail'] = $time;
					$data_mail['voucher_code'] = $voucher;


					//from DB
					$template = $this->rep->getMailTemplate($lang, $bkcode);
					$data_mail['name'] = $template->name;
					$data_mail['title'] = $template->title;
					$data_mail['body'] = $template->body;
					$data_mail['total_cost'] = $total_cost;

					// add event to google calendar
					$google_client = new Authorize($google_id);
					$calendar = new Calendar($google_client->client, $google_id);
					$calendar->addEvent($data_calendar);

					// send email to company
					// to do

					// send email to client
					if($bkcode == 'TP'){
						$to = $contactinfo->email;
						$message = 'Your Prague Solve Reservation is approved!';
						$headers = "From: thrillparkprague@gmail.com" . "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$body = '<!DOCTYPE html>
								<html>
								<body>
								<p>Hello, '.$contactinfo->firstname.' '.$contactinfo->lastname.', <br>
								your reservation for Escape Game in Virtual Reality was successful!</p>
								<p>Here are the details of your booking:<br>Reservation starts: '.$reservation->date.'</p>
								<p>The price will be: '.$reservation->people.' people ('.$total_cost.' CZK)</p>
								<p>1. Arrive at least 5 minutes ahead of your reservation.</p>
								<p>2. Here is <a href="https://www.google.com/maps?ll=50.077113,14.428611&z=16&t=m&hl=cs-CZ&gl=CZ&mapclient=embed&daddr=Thrill+Park+Prague+%C5%BDitn%C3%A1+1691/44+120+00+Nov%C3%A9+M%C4%9Bsto@50.07711279999999,14.4286112">where you will find us.</a></p>
								<p>3. If you have any questions or you just want to get in touch - <a href="http://m.me/thrillparkprague">write us on Facebook.</a></p>

								THRILL PARK TEAM<br>
								+420 774 413 313<br>
								thrillparkprague@gmail.com;
								</body>
								</html>
								';
						//$body = "<html><head><title>Your email at the time</title></head>" .
						//	"<body> <p><b>Name</b>: </b>{$_POST['contactname']}</p><p><b>Email: </b>{$_POST['contactemail']}</p><p><b>Subject: </b>{$_POST['contactsubject']}</p><p><b>Message: </b> {$_POST['contactmessage']}</p><br /></body>";
						mail($to, $message, $body, $headers);
						return $unique_id;
					}
					if($bkcode == 'TPVRT'){
						$to = $contactinfo->email;
						$message = 'Your Prague Solve Reservation is approved!';
						$headers = "From: thrillparkprague@gmail.com" . "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$body = '<!DOCTYPE html>
								<html>
								<body>
								<p>Hello, '.$contactinfo->firstname.' '.$contactinfo->lastname.', <br>
								your reservation for Zombie Shooting in Virtual Reality was successful!</p>
								<p>Here are the details of your booking:<br>Reservation starts: '.$reservation->date.'</p>
								<p>The price will be: '.$reservation->people.' people ('.$total_cost.' CZK)</p>
								<p>1. Arrive at least 5 minutes ahead of your reservation.</p>
								<p>2. Here is <a href="https://www.google.com/maps?ll=50.077113,14.428611&z=16&t=m&hl=cs-CZ&gl=CZ&mapclient=embed&daddr=Thrill+Park+Prague+%C5%BDitn%C3%A1+1691/44+120+00+Nov%C3%A9+M%C4%9Bsto@50.07711279999999,14.4286112">where you will find us.</a></p>
								<p>3. If you have any questions or you just want to get in touch - <a href="http://m.me/thrillparkprague">write us on Facebook.</a></p>

								THRILL PARK TEAM<br>
								+420 774 413 313<br>
								thrillparkprague@gmail.com;
								</body>
								</html>
								';
						//$body = "<html><head><title>Your email at the time</title></head>" .
						//	"<body> <p><b>Name</b>: </b>{$_POST['contactname']}</p><p><b>Email: </b>{$_POST['contactemail']}</p><p><b>Subject: </b>{$_POST['contactsubject']}</p><p><b>Message: </b> {$_POST['contactmessage']}</p><br /></body>";
						mail($to, $message, $body, $headers);
						return $unique_id;
					}

					$mail = new Mail($google_client->client, $google_id);
					$mail->sendMail($data_mail);
					/*$mail = new MailTest($google_client->client, $google_id, $bkcode);
					$mail->sendMail($data_mail);*/
 					// send uniq id if success, else send state "pick"
					return $unique_id;
				}
			}

			else
			{
				if ($state) return 'available';
            else return 'peak';
			}
		}

		return 'error';
	}

	function getLang($lang) {
		switch ($lang) {
			case 'Czech':
				return 'CZK';
				break;
			case 'English':
				return 'ENG';
				break;
			case 'Russian':
				return 'RUS';
				break;
			default:
				return 'lang not found';
				break;
		}
	}

	function crypt_unique($str) {
		return substr(md5($str), 2, 10);
	}

	///////////////////////////
	//	DELETE RESERVATION  //
	///////////////////////////
	function deleteReservation($unique_id, $lang) {
		//some internal info
		$internalInfo = $this->rep->getInternalInfo($this->city);
		$google_id = (string)$internalInfo->google_id;
		$google_client = new Authorize($google_id);

		//Change color of DELETED EVENT in calendar into GRAY
		$serviceCal = new Google_Service_Calendar($google_client->client);
		$eventCal = $serviceCal->events->get('primary', $unique_id);
		//$event->setTransparency('opaque');
		$eventCal->setColorId('8');
		$eventCal->setSummary('|_CANCELLED_|  '.strtolower($eventCal->getSummary()));
		$updatedEvent = $serviceCal->events->update('primary', $eventCal->getId(), $eventCal);



		//END changing color



		$reserv_del = $this->rep->selectReservationByUnique($unique_id);

		 //if try to delete after reservation gone ->  send everything ok, but do not remove the records
		if ($reserv_del->date < date("Y-m-d")) {
			$response = $this->rep->getDeleteResponse($lang);
			return '{"success":'. json_encode($response->success) .'}';
		}

		if($reserv_del) {
			$reserv_status = $this->rep->deleteReservationById($reserv_del->reservationid);



			if($reserv_status == 1) {
				$contact_status = $this->rep->deleteContactInfoById($reserv_del->contactinfoid);

				if($contact_status == 1) {
					$calendar = new Calendar($google_client->client, $google_id);
					$event_status =  $calendar->deleteEvent($unique_id)->getBody()->getContents();

					if($event_status == '') {
						$this->rep->reduceUsed($reserv_del->voucher);
						$response = $this->rep->getDeleteResponse($lang);
						return '{"success":'. json_encode($response->success) .'}';
					}
				}
			}
		} else {
			$calendar = new Calendar($google_client->client, $google_id);
			$event_status =  $calendar->deleteEvent($unique_id)->getBody()->getContents();

			if($event_status == '') {
				$this->rep->reduceUsed($reserv_del->voucher); //reduce number of voucherUsed to client use it later
				$response = $this->rep->getDeleteResponse($lang);
				return '{"success":'. json_encode($response->success) .'}';
			}
		}



		//$response = $this->rep->getDeleteResponse($lang);
		//return '{"error":'. json_encode($response->error) .'}';
	}
}
?>