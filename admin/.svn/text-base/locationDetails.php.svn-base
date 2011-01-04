<?php

include_once('includes/config.php');

$location = new Location($FORM['id']);

if($FORM['save']=='Save'){
	$location->save_from_form($FORM);
	$messages[] = "Saved Changes";
}

$smarty->assign("pageTitle", "Editing Property");
$smarty->assign('location', $location->to_array());
$smarty->assign("body", $smarty->fetch("admin_locationDetails.tpl"));
$smarty->display("index.tpl");

?>
asdf