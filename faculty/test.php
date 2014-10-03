<?php
    session_start();
    include ("lib/connection.php");
    
    if (empty($_SESSION['faculty'])) 
    {
        header("Location: index.php");
        exit();
    }

    $member = $_SESSION['faculty'];
    $member = mysqli_real_escape_string($mysqli, $member);

    $sqlQuery = "SELECT memberID FROM faculty WHERE id = '$member'";
    $resQuery = $mysqli->query($sqlQuery);
    $dataQuery = $resQuery->fetch_array();
    $memberID = $dataQuery['memberID'];
    $memberArray = array();

    if ($memberID == 999)
    {
        $sqlQuery = "SELECT memberID FROM multipleFaculty WHERE id = '$member'";
        $resQuery = $mysqli->query($sqlQuery);
        while ($dataQuery=$resQuery->fetch_array())
        {
            $memberArray[] = $dataQuery[0];
        }
    }
    else
        $memberArray[] = $memberID;    
    $string = "(";
    $size = sizeof($memberArray);
    $string = $string . $memberArray[--$size];
    
    while($size--)
        $string = $string . "," . $memberArray[$size];
    
    $string = $string.")";

    echo $string;

?>