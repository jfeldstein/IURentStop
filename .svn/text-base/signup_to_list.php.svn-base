<?php
include_once('includes/config.php');

$sql = "INSERT INTO `list_members` "
	."(`email`, `list_id`) "
	." VALUES "
	."('".$FORM['email']."', 1) ";

if($FORM['email']<>'')
	$db->Run($sql);
	
$_SESSION['messages'][] = "Thanks, we'll help you find the best place next year!";

if($FORM['forward'])
	header('Location: '.str_replace('&amp;','&',$FORM['forward']));
	
exit;

?>