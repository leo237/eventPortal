<?php
	session_start();
	unset($_SESSION['memberId']);
	unset($_SESSION['dsw']);
	unset($_SESSION['faculty']);
	unset($_SESSION['name']);
	session_destroy();
	header("Location: index.php");
	exit();
?>