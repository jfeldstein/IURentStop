<?php
$require_login = true;
include_once('includes/config.php');

$obj = ($FORM['on']=='space') ? new Space($FORM['id']) : new Location($FORM['id']);

if($FORM['action']=='add')
{
	$obj->tag_with($FORM['new_tag']);
}
 elseif($FORM['action']=='delete')
{
	
}

// Sloppy, but this needs to be before showing the ajaxable data
$smarty->assign('tags', $obj->tags);
		
if(isset($FORM['ajax']))
{
	$smarty->display('_taglist.tpl');
	exit;
}

switch($FORM['on'])
{
	case 'space':
		$location = new Location($obj->belongs_to_location_id);
		$smarty->assign('space', $obj->to_array());
	break;
	
	case 'location':
		header("Location: editlisting.php?id=".$obj->id);
	break;
}


$smarty->assign('location', $location->to_array());
$smarty->assign('form', $FORM);

$smarty->assign("pageTitle", "Edit This Listing's Amenities");
$smarty->assign("body", $smarty->fetch("edit_tags.tpl"));
$smarty->display("popup.tpl");	

?>