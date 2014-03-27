<?php
session_start();
include("lib/connection.php"); 
if (empty($_SESSION['dsw']))
{
    header("Location: index.php");
    exit();
}

$status = $_REQUEST['verify'];
$eventId= $_REQUEST['eventid'];

if ($status == "Yes")
{
	$finalStatus = "yes";
	$mesStat = "APPROVED";
}
else if ($status = "No")
{
	$finalStatus = "rejected";
	$mesStat = "NOT APPROVED!";
}
else 
{
	$finalStatus = "pending";
}

$sql = "UPDATE event 
			SET
				verificationStatus = '$finalStatus' 
			WHERE 
				eventId = '$eventId' ";
$res = $mysqli->query($sql);

$res = $mysqli->query($sql);


if ($res)
{
    $message = "The last event was <strong>$mesStat</strong>!";
    $_SESSION['message'] = $message;
    unset($_SESSION['eventId']);
    header ("Location: landing.php");
}