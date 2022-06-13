<?php
//require './lib/vendor/autoload.php';

require dirname(__DIR__).'/viewmodel/Day.php';
require dirname(__DIR__).'/viewmodel/Service.php';
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';
require dirname(__DIR__).'/logic/Mail.php';
require dirname(__DIR__).'/repository/Repository.php';

class Json {

	var $rep;

	function __construct() {
		$this->rep = new Repository();
	}
	
	////////////////////
	//	GET SERVICES  //
	////////////////////
	function getServices() {
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

	////////////////////////
	//	GET RESERVATIONS  //
	////////////////////////
	function getReservations($game_name, $amountPlayers, $date_input) {
		//some internal info
		$internalInfo = $this->rep->getInternalInfo();

		$start = (int)$internalInfo->openat * 60;
		$end = (int)$internalInfo->closeat * 60;
		$period = (int)$internalInfo->period;
		$timezone = (string)$internalInfo->timezone;

		//some information about service
		$service = $this->rep->getServiceByName($game_name);
		$max_players=(int)$service->max_players;
		$min_players =(int)$service->min_players;
		$duration = (int)$service->duration;
		$url = (string)$service->url;

		//timezone for generate date
		date_default_timezone_set($timezone);

		$days = array();

		//construct days array for some period
		for($day=0; $day < $period; $day++) {
			//get date
			///NEW!!!!!!!!!
			$date = date('Y-m-d', strtotime($date_input . ' +' . $day.' day'));

			$days[] = new Day($date);

			$step = $this->getIterationStep($game_name);

			//construct time hours for this day
			for($time = $start; ($time+$duration) <= $end; $time += $step) {

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

	function isTimeAvailable($date, $time, $start, $end, $timezone, $game_name, $duration, $max_players, $min_players, $amountPlayers) {
		//get iteration step
		$step = $this->getIterationStep($game_name);

		//get amount of people of each hour
		///NEW!!!!!!!!
		$peopleForEachHour = $this->getArrayReservationsForDay($date, $start, $end, $timezone, $game_name)['peopleForEachHour'];

		///NEW!!!!!!!!
		$peopleForThatGame = $this->getArrayReservationsForDay($date, $start, $end, $timezone, $game_name)['peopleForThatGame'];

		//minimal players
		if($amountPlayers < $min_players) {
			//min amount of players
			$amountPlayers = $min_players;
		} 

		//if old date -> 'peak'
		if($date < date('Y-m-d')) {
			return 'peak';
		}

		//if old hour -> 'peak'
		if($date == date('Y-m-d')) {
			$now = $this->getMinutes(date('H:i:s'));

			if($now > $time) {
				return 'peak';
			}
		}

		//if hour not be in open hours -> 'peak'
		if($time+$duration < $start || $time+$duration > $end) {
			return 'peak';
		}


	

		//iterate through hours of each game 
		for($i=0; $i < $duration; $i += $step) {
			///NEW!!!!!!!!!!
			$free_seats = 8 - $peopleForEachHour[$time + $i];

			///NEW!!!!!!!!!!
			$free_slots = $max_players - $peopleForThatGame[$time + $i];
			
			///NEW!!!!!!!!!!
			$free_places = min($free_seats, $free_slots);

			//show free places only if free_places == 'min_players'
			if($free_places % $min_players != 0) {
				$free_places -= 1;
			}

			//if we do not have enough free places -> $time is 'peak' 
			if($free_places < $amountPlayers) {
				return 'peak';
			}
		}

		return 'available';
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
		$internalInfo = $this->rep->getInternalInfo();

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
		$voucher = $reservation->voucher;
		$voucherGroup = $this->rep->getGroupByVoucherCode($voucher); //array has final [price], [color] of calendar, [code] game code
		$voucherPrice = (int)$voucherGroup->price;

		$total_cost = ($voucherPrice > 0 ? $voucherPrice*(int)$reservation->people : (int)$reservation->total_cost); //if voucherPrice has no final price (<0) then use normal price, otherwise use voucherGroup price
		$gameCode = (string)$voucherGroup->code;
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
			$state = $this->isTimeAvailable($date, 
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

			if($state == 'available') 
			{	
				$now = DateTime::createFromFormat('U.u', microtime(true));
				$unique_id = $this->crypt_unique($now->format("m-d-Y H:i:s.u").''.$contactinfo->email);


				

				if($voucher == '') {
					$voucher = '&mdash;&emsp;';
				}
				else{
					$this->rep->addUsed($voucher);
				}
				

				$status_reservation = $this->rep->insertReservation($date, $time, $reservation->people, $total_cost, $contactinfo->email, $reservation->game_name, $lang, $unique_id, $voucher);

			

				
				if($status_reservation == true) {
					$delete_link = 'https://'.$_SERVER['HTTP_HOST'].'/booking/delete.html?reserv='.$unique_id.'&lang='.$lang;

					$summary = $total_cost .' Kč - ' . $reservation->people . ' ' . $lang . ' '. $gameCode.' ' . $game_name .' '. $contactinfo->firstname . ' ' . $contactinfo->lastname;

					//$summary = $contactinfo->firstname . ' ' . $contactinfo->lastname . ' - ' .
					//		   $reservation->people . ' PLAYERS - ' . $game_name . ' (' . $lang . ')';

					$description = 'Client: <b>'.$contactinfo->firstname.' '.$contactinfo->lastname.'</b><br>'.
								   'Phone: <b>'.$contactinfo->phone.'</b><br>'. 
								   'Email: <b>'.$contactinfo->email.'</b><br>'. 
								   'Players: <b>'.$reservation->people.' PLAYERS</b><br>'.
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
					$template = $this->rep->getMailTemplate($lang);
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
					$mail = new Mail($google_client->client, $google_id);
					$mail->sendMail($data_mail);
 					// send uniq id if success, else send state "pick"
					return $unique_id;
				}
			}

			else 
			{
				return $state;
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
		$internalInfo = $this->rep->getInternalInfo();
		$google_id = (string)$internalInfo->google_id;
		$google_client = new Authorize($google_id);

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




