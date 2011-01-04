<?php
$require_login = true;
include_once('includes/config.php');

$location = new Location($FORM['id']);

if($location->id==-1 OR $location->belongs_to_user_id<>$User->id)
	header("Location: welcome.php");

$smarty->assign("pageTitle", 'Edit This Listing');
$smarty->assign("edit_space_id", $FORM['sid']);
$smarty->assign('form', $FORM);
$smarty->assign("location", $location->to_array());	
$smarty->assign("house_availables", array('0'=>'No', '1'=>'Yes'));
$smarty->assign("body", $smarty->fetch("editlisting_form.tpl"));
$smarty->display("index.tpl");	
?>