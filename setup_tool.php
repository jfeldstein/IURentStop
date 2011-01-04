<?php

include_once('includes/config.php');

if(!in_array($FORM['tool'], array('facebook','google','craigslist')))
{
	$_SESSION['messages'][] = "That tool couldn't be set up, I didn't recognize the name";
	header("Location: welcome.php");
	exit;
}	

if($FORM['enable'] <> '')
{
	$User->enable_tool($FORM['tool']);
}

if($FORM['disable'] <> '')
{
	$User->disable_tool($FORM['tool']);
}


if($User->tools[$FORM['tool']]) {
	$smarty->assign('tool_enabled', true);
}

$smarty->assign('body', $smarty->fetch("setup_".$FORM['tool']."_tool.tpl"));
$smarty->display('index.tpl');


?>