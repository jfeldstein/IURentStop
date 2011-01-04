<?php
$require_login = true;
include_once('includes/config.php');

if($FORM['id']=='new')
{
	$location = new Location($FORM['location_id']);
	if($location->new_space_from_form($FORM) === false AND !($location->type='house' AND count($location->spaces)>0)) {
		$_SESSION['messages'][] = $location->error;
		$_SESSION['saved_form'] = serialize($FORM);
		header('Location: editlisting.php?sid=new&id='.$FORM['location_id']);
		exit;
	}
	
	header('Location: editlisting.php?id='.$FORM['location_id']);
	exit;
}

$space = new Space($FORM['id']);

if($space === false)
	header("Location: welcome.php");
	

if($FORM['action']=='delete')
	$space->delete();
else
	$space->save_from_form($FORM);

header("Location: editlisting.php?id=" . $space->belongs_to_location_id);
?>