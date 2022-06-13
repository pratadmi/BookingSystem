<?php

class Repository {





function insertEvent($date, $time, $room_id, $stations, $comment) {
		$sql = "insert into events (date, time, room_id, stations, comment)
							values (:date, :time, :room_id, :stations, :comment)";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam('date', $date);
			$stmt->bindParam('time', $time);
			$stmt->bindParam('room_id', $room_id);
			$stmt->bindParam('stations', $stations);
			$stmt->bindParam('comment', $comment);
			$status = $stmt->execute();
			$db = null;
			return $status;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
}



function get_stations_number($room = false)
{
	$where = "";

	if($room)
	{
		$where = "WHERE id = ".(int)$room;
	}

$sql = "SELECT id,stations FROM  `rooms` {$where} ORDER BY `id`";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$info = $stmt->fetchAll(PDO::FETCH_OBJ);
	$db = null;
	return $info;
	} catch(PDOException $e) {
	return $e->getMessage();
	}
}



function get_events($date,$hour) {

$sql = "select room_id,stations from events where date=:date and time=:time";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
   $stmt->bindParam("date", $date);
	$stmt->bindParam("time", $hour);
	$stmt->execute();
   $val = [];
   while ($id = $stmt->fetchObject())
      array_push($val,$id);
	$db = null;
   $station = [];
   foreach ($val as $id)
      $station[$id->room_id] = $id->stations;
   return $station;
} catch(PDOException $e) {
	return $e->getMessage();
}
}

function get_day($date) {
$sql = "select reservationid, time, people, duration, rooms, name from reservations r, service s where r.serviceid = s.serviceid and date=:date";
try {
   $db = $this->getConnection();
   $stmt = $db->prepare($sql);
   $stmt->bindParam("date", $date);
   $stmt->execute();
   $val = [];
   while ($id = $stmt->fetchObject())
      array_push($val,$id);
   $db = null;
   return $val;
} catch(PDOException $e) {
   return $e->getMessage();
}
}

function get_names() {
$sql = "select * from rooms";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$name = [];
   while ($id = $stmt->fetchObject())
      $name[$id->id] = $id->name;
	$db = null;
   return $name;
	} catch(PDOException $e) {
	return $e->getMessage();
	}
}

function get_id_type() {
$sql = "select id,type from service_type";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
   $val = [];
   while ($id = $stmt->fetchObject())
      array_push($val,$id);
	$db = null;
   return $val;
} catch(PDOException $e) {
	return $e->getMessage();
}
}

function get_id_stations() {
$sql = "select id,stations from rooms";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$val = [];
   while ($id = $stmt->fetchObject())
      array_push($val,$id);
	$db = null;
   return $val;
} catch(PDOException $e) {
	return $e->getMessage();
}
}

function get_typeid_roomid() {
$sql = "select service_type_id,room_id from service_type_rooms";
try {
	$db = $this->getConnection();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$val = [];
   while ($id = $stmt->fetchObject())
      array_push($val,$id);
	$db = null;
   return $val;
} catch(PDOException $e) {
	return $e->getMessage();
}
}

	function getInternalInfo($city) {
		$sql="select address, google_id, timezone, openat, closeat, period, rooms_space from infoclub where city = :city";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("city", $city);
			$stmt->execute();
			$info = $stmt->fetchObject();
			$db = null;
			return $info;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getDataToSynchronize($date) {
		$sql = "select c.firstname, c.lastname, c.phone, c.email,
					   s.name, s.duration,
					   r.people, r.langname, r.voucher, r.unique_id, r.date, r.time
				from reservations r, contactinfo c, service s
				where r.contactinfoid = c.contactinfoid and
				      r.serviceid = s.serviceid and
				      month(date) = month(:date) and r.unique_id = '927ea1ea3c';";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("date", $date);
			$stmt->execute();
			//$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			$data = $stmt->fetchObject();
			$db = null;
			return $data;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getMailTemplate($lang, $bkcode) {
		$sql="select name, title, body from mailtemplate where langid = :lang";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("lang", $lang);
			$stmt->execute();
			$mail = $stmt->fetchObject();
			$db = null;
			return $mail;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getDeleteResponse($lang) {
		$sql = "select success, error from deletetemplate where langid = :lang;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("lang", $lang);
			$stmt->execute();
			$response = $stmt->fetchObject();
			$db = null;
			return $response;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	//get day reservations for view in web's table
	function getReservationsForDay($day, $type_game) { // Add type game
		$sql = "select reservationid, time, people, duration, rooms, name from reservations r, service s
				where r.serviceid = s.serviceid and date=:day and type=:type_game
				order by r.time;";
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("day", $day);
			$stmt->bindParam("type_game", $type_game);
			$stmt->execute();
			$resrv = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $resrv;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getReservationsForDayFull($day, $type_game) { // Add type game
		$sql = "select reservationid, time, people, duration, c.firstname, s.name, r.unique_id from reservations r, service s, contactinfo c
				where r.serviceid = s.serviceid and r.contactinfoid = c.contactinfoid and date=:day and type=:type_game
				order by r.time;";
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("day", $day);
			$stmt->bindParam("type_game", $type_game);
			$stmt->execute();
			$resrv = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $resrv;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getTypeService($game_name) {

		//$sql="select type from service where name=:game_name;";
		$sql="select type from service_type where id in(select service_type_id from service where name=:game_name);";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("game_name", $game_name);
			$stmt->execute();
			$type_service = $stmt->fetchObject();
			$db = null;
			return $type_service;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}


	function getRoomsByTypeService($type) {

		$sql="	SELECT stations
				FROM rooms
				INNER JOIN service_type_rooms ON rooms.id = service_type_rooms.room_id
				INNER JOIN service_type ON service_type_rooms.service_type_id = service_type.id
				WHERE service_type.type =  :type";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("type", $type);
			$stmt->execute();
			$stmt->execute();
			$type_service = [];
			while ($row = $stmt->fetchObject())
			array_push($type_service,$row);
			$db = null;
			return $type_service;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}


	function getServices() {
		$sql="select name, max_players, min_players, duration, price, image_preview, url from service ORDER by displayOrder;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$services = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $services;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getServicesByName($name_service) {
		$sql="select name, max_players, min_players, duration, price, image_preview, url from service where name=:name_service;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name_service", $name_service);
			$stmt->execute();
			$services = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $services;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}



	function getServicesNames() {
		$sql="select name from service;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$services = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $services;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}


	function getGroupByVoucherCode($voucher_code) { // get rules of a voucher by the code
		$sql = "SELECT voucher_groups.post_price AS price, voucher_groups.game_code AS code, voucher_groups.template_color AS color, voucher_groups.prefix AS prefix
				FROM vouchers
				INNER JOIN voucher_groups ON vouchers.groupid = voucher_groups.id
				WHERE vouchers.code =  :voucher_code;";
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("voucher_code", $voucher_code);
			$stmt->execute();
			//$info = $stmt->fetchObject();
			$groupData = $stmt->fetchObject();
			$db = null;
			return $groupData;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function updateinfoclub() {
		$sql="update service set max_players=1 where name='Virtualizer';";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$db = null;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	//UPDATE TheTable SET RevisionId = RevisionId + 1 WHERE Id=@id
	function addUsed($voucher_code) {
		$sql="UPDATE vouchers
    		  SET used = used + 1
    		  WHERE code = '".$voucher_code."'";
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$db = null;
		} catch(PDOException $e) {
			return $e->getMessage();
		}

	}

	function reduceUsed($voucher_code) {
		$sql="UPDATE vouchers
    		  SET used = used - 1
    		  WHERE code = '".$voucher_code."'";
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$db = null;
		} catch(PDOException $e) {
			return $e->getMessage();
		}

	}

	function getInfoClub() {
		$sql="select * from infoclub;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$info = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $info;
			$db = null;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getLanguageByNameService($name_service) {
		$sql="select l.name as lang
				from service s, language l
				where s.serviceid=l.serviceid and s.name=:name_service;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name_service", $name_service);
			$stmt->execute();
			$services = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $services;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}
 	//licenses added
	function getServiceByName($name_service) {
		$sql="select name, max_players, min_players, licenses, duration from service where name=:name_service;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name_service", $name_service);
			$stmt->execute();
			$service = $stmt->fetchObject();
			$db = null;
			return $service;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	//insert
	function isContactExist($email) {
		$sql = "select email from contactinfo where email=:email";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("email", $email);
			$stmt->execute();
			$emailFromDB = $stmt->fetchObject();
			$db = null;
			return $emailFromDB;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function insertContactInfo($firstname, $lastname, $email, $phone) {
		$sql = "insert into contactinfo (firstname, lastname, email, phone)
					values (:firstname, :lastname, :email, :phone)";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam('firstname', $firstname);
			$stmt->bindParam('lastname', $lastname);
			$stmt->bindParam('email', $email);
			$stmt->bindParam('phone', $phone);
			$status = $stmt->execute();
			$db = null;
			return $status;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function insertReservation($date, $time, $people, $total_cost, $email, $game_name, $langname, $unique_id, $voucher, $state) {
        $rooms = implode(',', $state);
		$sql = "insert into reservations (date, time, people, total_cost, contactinfoid, serviceid, langname, unique_id, voucher, rooms)
				values
					(:date, :time, :people, :total_cost,
						(select contactinfoid from contactinfo where email=:email),
						(select serviceid from service where name=:game_name), :langname, :unique_id, :voucher, :rooms)";

		try {
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
		}
	}

	function selectReservationByUnique($unique_id) {
		$sql = "select reservationid, contactinfoid, langname, date, voucher from reservations where unique_id = :unique_id;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam('unique_id', $unique_id);
			$stmt->execute();
			$reserv = $stmt->fetchObject();
			$db = null;
			return $reserv;
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function deleteReservationById($id) {
		$sql = "delete from reservations where reservationid = :id;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam('id', $id);
			$stmt->execute();
			$db = null;
			return $stmt->rowCount();
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function deleteContactInfoById($id) {
		$sql = "delete from contactinfo where contactinfoid = :id;";

		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam('id', $id);
			$stmt->execute();
			$db = null;
			return $stmt->rowCount();
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	function getConnection() {
		$dbhost="c100um.forpsi.com";
		$dbuser="f106443";
		$dbpass="NvSS6EgJ";
		$dbname="f106443";

		$db = new PDO("mysql:host=$dbhost;dbname=$dbname;", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}

	// function getConnection() {
	// 	$dbhost="127.0.0.1";
	// 	$dbuser="mysql";
	// 	$dbpass="mysql";
	// 	$dbname="booking";
	// 	// $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	// 	// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 	$dbh = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	// 	return $dbh->server_info;
	// }


	// function getConnection() {
	// 	$dbhost="c100um.forpsi.com";
	// 	$dbuser="f106443";
	// 	$dbpass="NvSS6EgJ";
	// 	$dbname="f106443";
	// 	//$db_port='3306';
	// 	// $dbh = new PDO("mysql:host=$dbhost;port=3306;dbname=$dbname;", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	// 	// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 	$dbh = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	// 	return $dbh->server_info;
	// }
}

?>