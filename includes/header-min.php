<?php
ob_start();
session_start();

//local path
$app_path = "http://" . $_SERVER['HTTP_HOST'] . "/my_sites/maktaba-tul-madina/";
$web_dir = "my_sites/maktaba-tul-madina/";

//live path
// $web_dir="admin/";
// $app_path="https://" . $_SERVER['HTTP_HOST'] . "/" . $web_dir;


$root_path=$_SERVER['DOCUMENT_ROOT'] . "/" . $web_dir;


include($root_path . "includes/dbcode.php");
include($root_path . "includes/main.php");
include($root_path . "includes/session.php");
include_once($root_path . "includes/file-upload.php");

//set global variables
$user_id = $_SESSION['mktb_user_id'];
?>