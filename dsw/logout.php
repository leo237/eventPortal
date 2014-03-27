<?php
	session_start();
	unset($_SESSION['memberId']);
	unset($_SESSION['dsw']);
	session_destroy();
	header("Location: index.php");
	exit();
?>