<?php
	
	require dirname(__DIR__).'/repository/Repository.php';
	ob_start();
	echo "i work";
	echo "<br>";
	//var_dump($_POST);
	$rep = new Repository();
	//$rep->insertEvent("12-11-2019", "14:00:00", "4", "1", var_dump($_POST));
	
	/*$date = "2019-11-18";
	$time = "17:45";
	$people = "1";
	$total_cost = "0";
	$email = "d.pratashchyk@gmail.com";
	$game_name  = "Virtualizer";
	$lang = "CZK";
	$unique_id = "3758aass9f";
	$voucher = "123";
	//$state = "4,";
	$state = array('4', '1', '2');*/
	$date = $_POST["date"];
	$time = $_POST["time"];
	$people = $_POST["people"];
	$total_cost = $_POST["total_cost"];
	$email = $_POST["email"];
	$game_name  = $_POST["game_name"];
	$lang = $_POST["lang"];
	$unique_id = $_POST["unique_id"];
	$voucher = $_POST["voucher"];
	$state = array('4');

	$result = $rep->insertReservation($date, $time, $people, $total_cost, $email, $game_name, $lang, $unique_id, $voucher, $state);
	echo $result;
	$htmlStr = ob_get_contents();	
	ob_end_clean(); 
	file_put_contents("outText", file_get_contents("outText").$htmlStr);
	
?>