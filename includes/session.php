<?php
ob_start();
if(!session_id()){ session_start(); }

if(!isset($_SESSION['mktb_user_id']) || $_SESSION['mktb_user_id']==""){
	
	session_unset('mktb_user_id');
	session_unset('mktb_user_name');
	session_unset('mktb_user_displayname');
	session_unset('mktb_role_id');
		
	$url = $app_path . "index.php";
	header ("Location: $url");
	exit;
}
?>
