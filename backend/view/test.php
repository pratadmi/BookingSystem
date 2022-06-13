<?php
//require __DIR__.'/../repository/Repository.php';
require dirname(__DIR__).'/viewmodel/Day.php';
require dirname(__DIR__).'/viewmodel/Service.php';
require dirname(__DIR__).'/logic/Authorize.php';
require dirname(__DIR__).'/logic/Calendar.php';
require dirname(__DIR__).'/logic/Mail.php';
require dirname(__DIR__).'/repository/Repository.php';
require __DIR__.'/../lib/vendor/autoload.php';
// date_default_timezone_set('Europe/Prague');


// 

$rep = new Repository();

$msg = new Google_Service_Gmail_Message();
//$this->service = new Google_Service_Gmail("d.pratashchyk@gmail.com");
//$mail = new Mail($google_client->client, $google_id);

echo "LOL";

/*$internalInfo = $rep->getInternalInfo();

		$address = (string)$internalInfo->address;
		$google_id = (string)$internalInfo->google_id;
		$start = (int)$internalInfo->openat * 60;
		$end = (int)$internalInfo->closeat * 60;
		$timezone = (string)$internalInfo->timezone;

		//timezone for generate date
		date_default_timezone_set($timezone);

		echo "I'm ok </br>";
		$voucher = "solve";
		$voucherGroup = $rep->getGroupByVoucherCode($voucher); //array has final [price], [color] of calendar, [code] game code
		var_dump($voucherGroup);
		$voucherPrice = (int)$voucherGroup->price;
		echo $voucherPrice;
		$total_cost = ($voucherPrice > 0 ? $voucherPrice : (int)$reservation->total_cost); //if voucherPrice has no final price (<0) then use normal price, otherwise use voucherGroup price
		$gameCode = (string)$voucherGroup->code;
		$calColor = (string)$voucherGroup->color;
		echo $calColor;

		echo "</br>";
		$internalInfo = $rep->getInternalInfo();
		var_dump($internalInfo);

		$address = (string)$internalInfo->address;
		$google_id = (string)$internalInfo->google_id;
		$start = (int)$internalInfo->openat * 60;
		$end = (int)$internalInfo->closeat * 60;
		$timezone = (string)$internalInfo->timezone;
		echo "</br>";
		


$data_calendar = array('id' => '11901110',
 					  'summary' => 'summary',
 					  'description' => 'description',
 					  'start_datetime' => date('c', strtotime('2018-11-10' . ' ' . '03:00')),
			 		  'end_datetime' => date('c', strtotime('2018-11-10' . ' ' . '04:00')));


$google_client = new Authorize($google_id);
					$calendar = new Calendar($google_client->client, $google_id);
					$calendar->addEvent($data_calendar);



*/




//$games = $rep->getServices();
//echo var_dump($rep->deleteReservationById('82'));
//$games = $rep->getServices();
//$rep->updateinfoclub();
//echo var_dump($rep->getReservationsForDay('2018-07-16', 'ESCAPE_ROOM'));

//echo var_dump($rep->updateInfoClub());
// $google_id = (string)$internalInfo->google_id;


// $google_client = new Authorize($google_id);

//echo var_dump($google_client->client);

// $calendar = new Calendar($google_client->client, $google_id);
// $calendar->addEvent($data_calendar);

// echo var_dump($google_client->client);

// $data_calendar = array('id' => "100",
// 					  'summary' => "SUmmary",
// 					  'description' => "description",
// 					  'start_datetime' => date('c', strtotime('2018-07-14' . ' ' . '23:00')),
// 					  'end_datetime' => date('c', strtotime('2018-07-14' . ' ' . '23:15')));
// $calendar = new Calendar($google_client->client, $google_id);
//echo var_dump($calendar->service);
//$calendar->addEvent($data_calendar);

//echo "hello";

//require './view/Json.php';
//date_default_timezone_set('Europe/Prague');
//$json = new Json();

//$rep = new Repository();

//echo $rep->getConnection();
//echo 'GOOGLE_APPLICATION_CREDENTIALS='.__DIR__.'/logic/secret/torchvrbk.json';
//echo var_dump($rep->getReservationsForDay('2018-07-14', 'ESCAPE_ROOM'));
//echo var_dump($rep->deleteReservationById(5)); 
//echo var_dump($rep->deleteReservationById(6));
//echo var_dump($rep->deleteReservationById(7));
//echo var_dump($rep->deleteReservationById(8));
//echo var_dump($rep->deleteContactInfoById(3));
//echo "hello";
// $dbhost="c100um.forpsi.com";
// $dbuser="f106443";
// $dbpass="NvSS6EgJ";
// $dbname="f106443";

// $db = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));	
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $stmt = $db->prepare("select * from service");  
// $stmt->execute();
// $service = $stmt->fetchObject();

// echo var_dump($service);


// $dbh = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
// if($dbh->connect_errno){
// 	echo "error: " . $dbh->connect_error;
// 	exit();
// }
// else {
// 	echo "success: " . $dbh->server_info;
// }


//echo $rep->getReservationToDelete('2018-07-04 13:27:38', 'developer.stepanov@gmail.com')->reservationid;
//$rep->insertReservation('2018-12-12', '14:00:00', 6, 1000, 'mail', 'Cosmos', 'CZK', '10001');

//echo var_dump($json->deleteReservation('1a383886b6'));

//echo $json->deleteReservation('54524405c9');

// $delete_link = 'http://vk.com';

// $body = '';
// $body .= '<h1>Test HTML MESSAGE!</h1>';
// $body .= '<p><a href={delete_link}>Zruseni rezervace</a></p>';

// $vars = array(
//   '{delete_link}' => $delete_link
// );

// echo strtr($body, $vars);

// $date = date('d.m.Y', strtotime('2018-08-21'));

// echo $date;

?>