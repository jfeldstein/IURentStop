<?php

include_once('includes/config.php');

if(!$User)
	exit("REGISTER");

if(in_array($FORM['id'], $User->starred_spaces))
{
	$User->unstar_space($FORM['id']);
	$src = "house_off.png";
}
 else
{	
	$User->star_space($FORM['id']);
	$src = "house_on.png";
}

if($FORM['ajax'])
{ echo "<img src='images/$src'>"; }
else
{ header("Location: viewlisting.php?id=".$FORM['id']); }

exit;

?>
