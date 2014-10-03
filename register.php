<?php

	include("lib/connection.php");

	$eventId = $_REQUEST['eventId'];
    $eventId = mysqli_real_escape_string($mysqli,$eventId);

	$name = $_REQUEST['name'];
	$name = mysqli_real_escape_string($mysqli,$name);
    
    $regNo = $_REQUEST['regNo'];
    $regNo = mysqli_real_escape_string($mysqli,$regNo);
	
    $phone = $_REQUEST['phone'];
    $phone = mysqli_real_escape_string($mysqli,$phone);

    $check = "SELECT * FROM registration WHERE 
                    regNo = '$regNo' AND 
                    eventId = '$eventId' ";
    $execCheck = $mysqli->query($check);

    $count = $execCheck->num_rows();

    if ($count==0)
    {
    	$sql = "INSERT INTO registration SET 
                    eventId = '$eventId',
                    name = '$name',
                    regNo = '$regNo',
                    phoneNumber = '$phone' " ;
        $res = $mysqli->query($sql);
        echo 1;
    }

    else echo "registered";    