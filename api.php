<?php

	include("lib/connection.php");
	$today = date ("Y-m-d"); 
	// $sql = "SELECT * FROM event 
	// 	WHERE 
	// 		dat > '$today' AND 
	// 		verificationStatus = 'yes' ORDER BY dat DESC";

	$sql = "SELECT event.eventId, member.name, event.title, event.dat, event.fromTime, event.till, event.location, event.description, event.poster FROM event, member
			WHERE 
				event.dat > '$today' AND
				verificationStatus = 'yes' AND
				event.memberId = member.id ORDER BY event.dat DESC ";
	$res = $mysqli->query($sql);

	$data = array();

	while ($result = $res->fetch_array())
	{
		$data[] = $result;
	}

	// print_r($data)
	$jsonPreObject = array();
	$i = 0;
	foreach ($data as $item)
	{
		 $jsonPreObject[$i][title] = $item[title];
		 $jsonPreObject[$i][dat] = $item[dat];
		 $jsonPreObject[$i][fromTime] = $item[fromTime];
		 $jsonPreObject[$i][till] = $item[till];
		 $jsonPreObject[$i][location] = $item[location];
		 $jsonPreObject[$i][description] = $item[description];
		 $jsonPreObject[$i][poster] = $item[poster];
		 $jsonPreObject[$i][chapter] = $item[name]; 
		 $i++;
	} 
	$jsonObject[events] = $jsonPreObject;
	$json = json_encode($jsonObject);
	echo $json;
?>
