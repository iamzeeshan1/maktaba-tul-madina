<?php
//Local Database
$hostname="localhost";
$mysql_login="root";
$mysql_password="";
$database="maktaba_inventory";

//Live Database
// $hostname="localhost";
// $mysql_login="u754628685_dawate_user";
// $mysql_password="7!pDF:S^b*";
// $database="u754628685_dawate_islami";

$link = mysqli_connect($hostname,$mysql_login,$mysql_password,$database);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
