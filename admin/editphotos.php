<?php
include_once('includes/config.php');

$location = new Location($FORM['location_id']);

$smarty->assign("pageTitle", 'Manage Photos');
$smarty->assign('target_type', $FORM['target_type']);
$smarty->assign('target_id', $FORM['target_id']);
$smarty->assign("location", $location->to_array());
$smarty->assign("body", $smarty->fetch("edit_photos.tpl"));
$smarty->display("popup.tpl");	

?>