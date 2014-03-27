<?php
	session_start();
	unset($_SESSION['memberId']);
	session_destroy();
	header("Location: index.php");
	exit();
?>