<?php
	session_start();
    
    include ("lib/connection.php");
    
    if (empty($_SESSION['memberId'])) 
    {
        header("Location: index.php");
        exit();
    }
	
	$eventNumber = $_SESSION['eventId'];

	$sql = "DELETE FROM event WHERE eventId = '$eventNumber' ";
	$res = $mysqli->query($sql);

	if ($res)
	{
		$_SESSION['message'] = "Event Deleted Successfully!";
		unset($_SESSION['eventId']);
		header ("Location: landing.php");
		exit();
	}
	else 
	{
		$_SESSION['message'] = "Oops! There was an error deleting that event. Please contact the administrator for help! ";
		unset($_SESSION['eventId']);
		header ("Location: landing.php");
		exit();
	}
?>
