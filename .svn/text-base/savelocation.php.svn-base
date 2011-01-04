<?php
$require_login = true;
include_once('includes/config.php');

$location = new Location($FORM['id']);

if($location->id==-1)
	header("Location: welcome.php");

if($FORM['delete'])
{
	$location->delete();
	$_SESSION['messages'][] = 'The location was deleted';
	header("Location: welcome.php");
	exit;
}

if($location->save_from_form($FORM) === false)
{
	$_SESSION['messages'][] = "We couldn't find this address in Bloomington.";
	$_SESSION['messages'][] = "See the <a href='faq.php#nogeocode'>help page</a> for more information.";
}

header("Location: editlisting.php?id=" . $location->id);
?>