<?php
	require_once("DBController.php");
	$db_handle = new DBController();

	//var_dump($_POST);
	$name = $_POST['name'];
	$discount = $_POST['discount'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$timeAvailable = $startTime."'".$endTime;
	$start_date = $_POST['start_date'];
	$max_times = $_POST['max_times'];
	$expDate = $_POST['expDate'];
	$ppl_amount = $_POST['ppl_amount'];
	$days = "";
	
	if ($_POST['Monday']) {
		$days=$days."Monday'";
		# code...
	}
	if ($_POST['Tuesday']) {
		$days=$days."Tuesday'";
		# code...
	}
	if ($_POST['Wednesday']) {
		$days=$days."Wednesday'";
		# code...
	}
	if ($_POST['Thursday']) {
		$days=$days."Thursday'";
		# code...
	}
	if ($_POST['Friday']) {
		$days=$days."Friday'";
		# code...
	}
	if ($_POST['Saturday']) {
		$days=$days."Saturday'";
		# code...
	}
	if ($_POST['Sunday']) {
		$days=$days."Sunday'";
		# code...
	}
	$days = rtrim($days, "'");
	//echo $days;
	$codes = "";

	if (isset($_POST['codes'])) {
		$codes = explode("\r\n", $_POST["codes"]);
		$codes = array_filter(array_map('trim', $codes));
	}

	foreach ($codes as $code) {

		if (strlen($code) < 4) {
			echo "code --->". $code."<--- is too short skipped!! RETARDED ENTER LONGER THAN 4<br>";
			continue 1;
		}

		//$voucherIDQuery = 'SELECT voucherid FROM vouchers WHERE code="'.$code.'"';
		//$result = $db_handle->getResult($voucherIDQuery);
		
		$voucherQuery = 'INSERT INTO vouchers (name, discount, daysAvailable, timeAvailable, code, max_times, used, start_date, expiration_date, ppl_amount)
						VALUES ("'.$name.'", "'.$discount.'", "'.$days.'", "'.$timeAvailable.'", "'.$code.'", "'.$max_times.'", 0,"'.$start_date.'", "'.$expDate.'", "'.$ppl_amount.'")';
		$result = $db_handle->getResult($voucherQuery);
		//if ($result)
		if (!$result) {

			echo "ERROR ADDING NEW VOUCHER<br>, probably you are retarded or the same VoucherCODE is already in the system<br><br> in the table you can which vouchers is in the system";
			continue 1;
			
		}

		$voucherIDQuery = 'SELECT voucherid FROM vouchers WHERE code="'.$code.'"';
		$result = $db_handle->getResult($voucherIDQuery);
		$id = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['voucherid'];
		
		if ($_POST['Cosmos']) {
			$cosmosQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",1)';						//change 1 to SElECT serviceid from services where name ="COSMOS" ну или иди нахуй
			$result = $db_handle->getResult($cosmosQuery);

		}
		if ($_POST['MindHorror']) {
			$MHQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",2)';						//change 2  to SElECT serviceid from services where name ="MH" ну или иди нахуй
			$result = $db_handle->getResult($MHQuery);
		
		}
		if ($_POST['Virtualizer']) {
			$VRTQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",3)';						//change 3 to SElECT serviceid from services where name ="VRT" ну или иди нахуй
			$result = $db_handle->getResult($VRTQuery);
		}
		if ($_POST['MEDUSA']) {
			$MedusaQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",5)';						//change 3 to SElECT serviceid from services where name ="VRT" ну или иди нахуй
			$result = $db_handle->getResult($MedusaQuery);
		}
		if ($_POST['ALICE']) {
			$AliceQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",6)';						//change 3 to SElECT serviceid from services where name ="VRT" ну или иди нахуй
			$result = $db_handle->getResult($AliceQuery);
		}
		if ($_POST['ETLP']) {
			$ELTPQuery = 'INSERT INTO voucher_service (voucher_id, service_id)
			VALUES ("'.$id.'",4)';						//change 3 to SElECT serviceid from services where name ="VRT" ну или иди нахуй
			$result = $db_handle->getResult($ELTPQuery);
		}
		//echo "code --->". $code."<--- is added under id".$id."<br>";
	}
	$tds= "";
	foreach ($codes as $code) {

		$voucherIDQuery = 'SELECT * FROM vouchers WHERE code="'.$code.'"';
		

		if ($db_handle->numRows($voucherIDQuery)==0 || $code=="") {
			echo "This code wasn't added by some reason ".$code;
			continue 1;
		}
		$result = $db_handle->getResult($voucherIDQuery);

		
		$tds = $tds."<tr>";
		$table = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		foreach ($table[0] as $value){
			$tds = $tds."<td>".$value."</td>";
			
		}
		$tds = $tds."</tr>";
	}

	$tableHTML=  '<style>
			table, th, td {
	 		 border: 1px solid black;
	 		 
			}
			td{
				text-align: center; 
			}
			table{
				width:100%;
			}
			</style>;
		<table style="width:100%;  border: 1px solid black;"><tr>
	    <th>ID</th>
	    <th>name</th> 
	    <th>discount</th>
	    <th>for days</th>
	    <th>for time</th> 
	    <th>code</th>
	    <th>max times use</th>
	    <th>used</th>
	    <th>start date</th> 
	    <th>experation date</th>
	    <th>for # ppl</th>
	    <th>always 0</th>
	    <th>Created</th>
	  	</tr>'
	  	.$tds.
	  	'</table>';

  	echo $tableHTML;
	
?>