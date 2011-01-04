<?php
include_once('includes/config.php');

if($FORM['action']!='')
{
	$obj = ($FORM['on']=='space') ? new Space($FORM['id']) : new Location($FORM['id']);
	$obj->tag_with($FORM['new_tag']);
}

switch($FORM['on'])
{
	case 'space':
		$space = new Space($FORM['id']);
		$location = new Location($space->belongs_to_location_id);
		$smarty->assign('space', $space->to_array());
		$smarty->assign('current_amenities', $space->tags);
	break;
	
	case 'location':
		$location = new Location($FORM['id']);
		header("Location: editlisting.php?id=".$location->id);
	break;
}


$smarty->assign('location', $location->to_array());
$smarty->assign('form', $FORM);

$smarty->assign("pageTitle", "Edit This Listing's Amenities");
$smarty->assign("body", $smarty->fetch("edit_tags.tpl"));
$smarty->display("popup.tpl");	

?>