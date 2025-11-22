<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1); //<---comment this to disable in production
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

 // InfinityFree Database Configuration
 $host = "sql112.infinityfree.com";
 $username = "if0_40373590";
 $password = "teestylehub";
 $database = "if0_40373590_teestylehub";

 $conn = mysqli_connect($host, $username, $password, $database);

if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}