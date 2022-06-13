<?php

	if (isset($_POST['username']) && isset($_POST['pass']) && ($_POST['username']=='admin') && ($_POST['pass']=='admin')) {

		$_SESSION['loggedin'] = true;

	}

    else {

    	$_SESSION['loggedin'] = false;

    	header('Location: login/login.html');

    }



?>



<!DOCTYPE html>

<html>

<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="js/main.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<link rel="stylesheet" type="text/css" href="css/main.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>

<body>





<form action="closeDays2.php" name="closeForm" method="post" onsubmit="return validateForm()">



  	<center>

  		<h2>	ATTENTION:  </h2>

  	<h2>	You must have permission or understand well what you are doing before making any changes in this system - if you are unsure contact someone from management (starting with Dima). 

</h2>

    <label for="startDay">1. Enter the date of the first day that needs to be closed:</label></br></br>

    <input type="text" id="startDay" name="dates" required></br></br>

    <label for="daysofweek">1.1 Check which days of the week needs to be closed</label></br></br>

    <input type="checkbox" name="daysofweek[1]" value="Monday" >Monday<br>

    <input type="checkbox" name="daysofweek[2]" value="Tuesday" >Tuesday<br>

    <input type="checkbox" name="daysofweek[3]" value="Wednesday" >Wednesday<br>

    <input type="checkbox" name="daysofweek[4]" value="Thursday" >Thursday<br>

    <input type="checkbox" name="daysofweek[5]" value="Friday">Friday<br>

    <input type="checkbox" name="daysofweek[6]" value="Saturday" >Saturday<br>

    <input type="checkbox" name="daysofweek[7]" value="Sunday" >Sunday<br></br></br>




    <label>How many stations will remain in room A</label></br></br>
    <input type="number" name="rooms[1]" min="0" max="4" required placeholder="4"></br>

        <label>How many stations will remain in room B</label></br></br>
    <input type="number" name="rooms[2]" min="0" max="4" required placeholder="4"></br>

        <label>How many stations will remain in room C</label></br></br>
    <input type="number" name="rooms[3]" min="0" max="2" required placeholder="2"></br>

        <label>How many stations will remain in Lounge</label></br></br>
    <input type="number" name="rooms[4]" min="0" max="1" required placeholder="1"></br>

    <!--<label for="startTime">Includes weekends?</label></br></br>

    <input type="checkbox" id="weekends" name="weekends"></br></br>-->


   

    <select name="message" required="">

        <option>Event</option>

        <option>Short Operational Hours</option>

        <option>Special Days</option>

         <option>Holiday</option>

          <option>Other</option>

    </select></br></br>

    <h2> 6. Submit after checking all the previous changes are correct.</h2>

  	<input type="submit">

  	</center>



</form>





<form action="../../voucher/addVoucher.php" name="closeForm" method="post" >

	<center>

		</br></br>

  		<h2>VOUCHER SYSTEM </h2>

    <center>

    

    <input type="text" id="name" name="name" required placeholder="Enter client name or voucher purpose:"></br></br>

    <input type="number" name="discount" min="0" max="100" required placeholder="Enter discount in %:"></br>

    </br></br>

    <label for="days">Check which days does voucher valid</label></br></br>

    <input type="checkbox" name="Monday" value="true" checked="true">Monday<br>

    <input type="checkbox" name="Tuesday" value="true" checked="true">Tuesday<br>

    <input type="checkbox" name="Wednesday" value="true" checked="true">Wednesday<br>

    <input type="checkbox" name="Thursday" value="true" checked="true">Thursday<br>

    <input type="checkbox" name="Friday" value="true" checked="true">Friday<br>

    <input type="checkbox" name="Saturday" value="true" checked="true">Saturday<br>

    <input type="checkbox" name="Sunday" value="true" checked="true">Sunday<br></br></br>

    <label for="startTime">Between which period of time should the voucher be valid for ( selecting from 14 - till 22 will make it for the whole day)</label></br></br>

    <input type="number" name="startTime" min="14" max="21" required placeholder="from"></br>

    <input type="number" name="endTime" min="15" max="22" required placeholder="till"></br></br>

    <label for="games">Choose the services for which the voucher is valid for </label></br></br>

    <input type="checkbox" name="Cosmos" value="true">Cosmos<br>

    <input type="checkbox" name="MindHorror" value="true">MindHorror<br>

    <input type="checkbox" name="Virtualizer" value="true">Virtualizer<br>

    <input type="checkbox" name="MEDUSA" value="true">MEDUSA'S GATE<br>

    <input type="checkbox" name="ALICE" value="true">ALICE<br>

    <input type="checkbox" name="ETLP" value="true">Escape The Lost Pyramid<br></br></br>

    <label for="games">If you want generate multiple voucher codes with the same rules you can add the codes here by writing a code on each line (i.e every time you enter a code hit the ENTER KEY) </label></br></br>

    <textarea id="codes" name="codes" rows="4" cols="35" required></textarea></br></br>

    <input type="number" name="max_times" min="1" max="1000" required placeholder="how many times can be voucher used"></br></br>

	<label for="days">voucher expiration date </label></br></br>

    <input type="date" id="expDate" name="expDate" required placeholder="expiration date"></br></br>

    <label for="days">voucher start date (from when should be valid) </label></br></br>

    <input type="date" id="start_date" name="start_date" required placeholder="start date"></br></br>

    <input type="number" name="ppl_amount" min="2" max="6" required placeholder="max ppl amount for this voucher"></br></br>

    

<!--



    <label for="startTime">Between which period of time should the sessions be closed</label></br></br>

    <input type="number" name="startTime" min="14" max="21" required placeholder="from"></br>

    <input type="number" name="endTime" min="15" max="22" required placeholder="till"></br></br>

    <label for="startTime">Includes weekends?</label></br></br>

    <input type="checkbox" id="weekends" name="weekends"></br></br>

    <label for="start">Enter blocked stations (8 means all)</label></br></br>

    <input type="number" name="stations" value="8" min="2" max="8" placeholder="number" required></br></br>

    <label for="start">For how many days do you want to apply this changes?(i.e Mon + 5 = Friday)</label></br></br>

    <input type="number" name="days" min="1" max="7" placeholder="days" required></br></br>

    <input type="text" name="message" placeholder="Comment/message" required></br></br>

    

-->

     <input type="submit">  

    </center>

     

</form>



</body>

</html>