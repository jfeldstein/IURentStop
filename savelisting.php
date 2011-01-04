<?php
include_once('includes/config.php');

if(!$User)
{
	exit('REGISTER');
}
 else
{
	$User->save_listing($FORM['space_id']);
	die("SAVED");
}
?>