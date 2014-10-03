<?php
session_start();
include("lib/connection.php"); 
if (empty($_SESSION['faculty']))
{
    header("Location: index.php");
    exit();
}
$faculty = $_SESSION['faculty'];
$faculty = mysqli_real_escape_string($mysqli, $faculty);


$status = $_REQUEST['verify'];
$status = mysqli_real_escape_string($mysqli, $status);


$eventId= $_REQUEST['eventid'];
$eventId = mysqli_real_escape_string($mysqli, $eventId);

$comments= $_REQUEST['comments'];
$comments = mysqli_real_escape_string($mysqli, $comments);

if ($status == "Yes")
{
	$finalStatus = "mid";
	$mesStat = "APPROVED";
}
else if ($status = "No")
{
	$finalStatus = "rejectedMid";
	$mesStat = "NOT APPROVED!";
}
else 
{
	$finalStatus = "pending";
}


$sql = "UPDATE event 
			SET
				verificationStatus = '$finalStatus',
				comments = '$comments',
				approvedBy = '$faculty' 
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