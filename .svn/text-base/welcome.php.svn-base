<?php
$require_login = true;
include_once('includes/config.php');

$smarty->assign('locations', $User->locations);
$smarty->assign('saved_spaces', $User->saved_spaces);


if(!$User->complete_contact AND $User->type=='owner')
	$messages[] = "Enter a <a href='editaccount.php'>phone number</a> so that students can ask about listings.";

$smarty->assign("body", $smarty->fetch("welcome.tpl"));
$smarty->display("index.tpl");	
?>