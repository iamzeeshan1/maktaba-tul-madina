<?php
ob_start();
if(!session_id()){ session_start(); }

session_unset('mktb_user_id');
session_unset('mktb_user_name');
session_unset('mktb_user_displayname');
session_unset('mktb_role_id');
session_destroy();

$url = "../../";
header ("Location: $url");
exit;

?>
