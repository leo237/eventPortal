<?php
 //define( "DB_SERVER",    $_ENV['OPENSHIFT_MYSQL_DB_HOST'] );

   // define( "DB_USER",      $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'] );

    //define( "DB_PASSWORD",  $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'] );

    //define( "DB_DATABASE",  $_ENV['OPENSHIFT_APP_NAME'] );

  // $hostname = "127.7.193.2";
  // $dbusername = "adminppanIGT";
  // $dbname  = "vita";
  // $dbpassword = "ryqux6mbdJ9A";
$hostname = "localhost";
$dbusername = "root";
$dbname = "vita";
$dbpassword = "";
  $mysqli = new mysqli($hostname, $dbusername, $dbpassword, $dbname);
  if (mysqli_connect_errno())
  {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  if(!isset($_SESSION))
	   session_start();

?>