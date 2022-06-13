<?php
class VSValidator {


    private $data;

    
    function __construct($data) {
        $this->data = $data;
        
    }

    function ifZazitkyVoucher($voucher_code) {
      
	  if (preg_match("^Z044[2-3][A-Z][0-9]{4}S{0,1}$", $voucher_code)){
	  	return true;
	  }
      
      return false;
    }


    function isServiceValid($gamename) {
      foreach($this->data AS $row) {
        if (strcmp($row['service_name'] , $gamename) == 0) { // if (strcmp($row['service_name'] , $_POST['gamename']) == 0) { 
          return true;
        }
      }
      
      return false;
    }

    function isVoucherStarted($reservation_date) {
       
        $reservation_date = strtotime(stripslashes($reservation_date));
        //echo $reservation_date;
        $reservation_date = date("Y-m-d",$reservation_date);
        //echo $reservation_date;
        if ($this->data[0]['start_date'] <= $reservation_date) {
           // echo "voucher is out of date";
            
            return true;
        }
        return false;
    }

    function isDateValid($reservation_date) {
       
        $reservation_date = strtotime(stripslashes($reservation_date));
        //echo $reservation_date;
        $reservation_date = date("Y-m-d",$reservation_date);
        //echo $reservation_date;
        if ($this->data[0]['expdate'] > $reservation_date) {
           // echo "voucher is out of date";
            
            return true;
        }
        return false;
    }

    function isDayValid($reservation_date) {
        $reservation_day = date('l', strtotime($reservation_date));
        $voucher_days = (explode ( "'" , $this->data[0]['daysAv']));
        foreach($voucher_days AS $voucher_day) {
            if (strcmp($voucher_day , $reservation_day) == 0) { // if (strcmp($row['service_name'] , $_POST['gamename']) == 0) { 
                return true;
            }
        }
        return false;
            
    }

    function isTimeValid($reservation_time) {
        $reservation_hour = date("H",strtotime($reservation_time));
        $voucher_hours    = (explode ( "'" , $this->data[0]['timeAv']));
        $start_hour       = $voucher_hours[0];
        $end_hour         = $voucher_hours[1];
        if ($reservation_time>=$start_hour && $reservation_time < $end_hour) { // change to && $reservation_time<=$end_hour if you want last hour be included
            return true;  
        }

        return false;
            
    }
    // implement % of the price
    function getExtraPrice($ppl_reserved) {
        $discount = $this->data[0]['discount'];
        $ppl_voucher = $this->data[0]['ppl_voucher'];
        $overload = $ppl_reserved - $ppl_voucher; //shows for how many ppl reservation overload compare with voucher
        $service_price = $this->data[0]['service_price'];
        $discounted_price = ceil($service_price*((100-$discount)/100)); // per person
        if ($overload > 0) {
            return ($overload*$service_price)+($ppl_voucher*$discounted_price);
        }
        else{
            return $ppl_reserved*$discounted_price;
        }
            
    }
}
    
    

?>