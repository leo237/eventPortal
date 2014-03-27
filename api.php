<?php

	include("lib/connection.php");
	$today = date ("Y-m-d"); 
	$sql = "SELECT * FROM event 
		WHERE 
			dat > '$today' AND 
			verificationStatus = 'yes' ORDER BY dat DESC";
	$res = $mysqli->query($sql);

	$data = array();

	while ($result = $res->fetch_array())
	{
		$data[] = $result;
	}

	$json = json_encode($data);

	file_put_contents('api.json', $json);

	//header("Location: api.json");
	
	print_r ($json);
?>
