<?php
$require_login = true;
include_once('includes/config.php');

foreach($User->starred_spaces as $space_id)
{
	$space = new Space($space_id);
	$location = new Location($space->belongs_to_location_id);
	$spaces[] = array_merge($location->to_array(), $space->to_array());
}

$smarty->assign('saved_spaces', $spaces);

$smarty->assign("pageTitle", 'Watched Listings');
$smarty->assign("body", $smarty->fetch("saved_spaces.tpl"));
$smarty->display("index.tpl");	
?>