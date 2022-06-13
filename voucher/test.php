<?php
require_once("DBController.php");
require_once("VSValidator.php");

$db_handle = new DBController();


  $answer = array();
  $voucher_code = trim("VANOCE2019KP");
  $ppl_reserved = 2;
  $_POST['gamename'] = 'ALICE_IN_WONDERLAND';
  $_POST['date'] = '23 December 2019';
  $_POST['time'] = '20:00';
  
  /*
  //$slevomatRegex = "[0-9]{4}-?[0-9]{4}-?[0-9]{2}[a-fA-F]{1}-?[0-9]{3}";  
  $exitGameRegex = "[0-9]{7}-[0-9]{6}-[0-9]{5}";
  $zazitkyRegex = "Z0442U[0-9]{4}";
  $stipsRegex = "[0-9]{16}";

	preg_match('/Z044[1-9]U[0-9]{4}/', $input_line, $output_array);
  if (preg_match('/Z044[1-9]U[0-9]{4}/',$voucher_code))
  {
    $answer['extra_price'] = 0;
    $answer['message'] = 200;
    echo json_encode($answer);
    exit();
  }*/

  $voucherQuery = "SELECT * FROM vouchers WHERE code='" . $voucher_code . "'";
  if ($db_handle->numRows($voucherQuery)==0 || $voucher_code=="") {
    $answer['message'] = 205;
    echo json_encode($answer);
   	exit();
  }
//Voucher Service = VS
  $VSQuery= "SELECT v.code voucher_code, 
                  s.name service_name, 
                  s.price service_price,
                  v.name voucher_name, 
                  v.max_times max, 
                  v.used used, 
                  v.expiration_date expdate, 
                  v.daysAvailable daysAv, 
                  v.timeAvailable timeAv,
                  v.ppl_amount ppl_voucher,
                  v.discount discount,
                  v.start_date start_date
                  FROM voucher_service sv
                  JOIN service s ON sv.service_id = s.serviceid
                  JOIN vouchers v ON sv.voucher_id = v.voucherid
                  WHERE v.code = '" . $voucher_code . "'
                  AND s.name =  '" . $_POST['gamename'] . "'
                  ORDER BY s.serviceid
                  LIMIT 0 , 30";

  $VSResult = $db_handle->getResult($VSQuery);
 
  
   // var_dump($result);  
  //check is it possible to use this voucher
    $data = mysqli_fetch_all($VSResult, MYSQLI_ASSOC);
    

    $validator = new VSValidator($data);



    if (!$validator->isVoucherStarted($_POST['date'])) {
      $answer['message'] = 207;
      echo json_encode($answer);
      exit();
    }

    
    if (!$validator->isDateValid($_POST['date'])) {
      $answer['message'] = 208;
      echo json_encode($answer);
      exit();
    }

    if (!$validator->isDayValid($_POST['date'])) {
      $answer['message'] = 203;
      echo json_encode($answer);
      exit();
    }

    if (!$validator->isTimeValid($_POST['time'])) {
      $answer['message'] = 204;
      echo json_encode($answer);
      exit();
    }


   
    if (!$validator->isServiceValid($_POST['gamename'])) {
      $answer['message'] = 222;
      echo json_encode($answer);
      exit();
    }

        if ($data[0]['max'] - $data[0]['used'] < 1) {
      $answer['message'] = 209;
      echo json_encode($answer);
      exit();
    }



    $extraPrice = $validator->getExtraPrice($ppl_reserved); //need to be added to be replaced by price
    
    $answer['extra_price'] = $extraPrice;
    $answer['message'] = 200;
    echo json_encode($answer);


    
?>