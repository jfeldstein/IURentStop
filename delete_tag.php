<?php
$require_login = true;
include_once('includes/config.php');



if($FORM['on']=='space')
{
	$space = new Space($FORM['id']);
	$space->untag($FORM['tag_id']);

	
	if(isset($FORM['ajax']))
	{	
		$smarty->assign('tags', $space->tags);
		$smarty->assign('form', $FORM);
		$smarty->display('_taglist.tpl'); 
		exit;
	}
	
	header("Location: edittags.php?on=".$FORM['on']."&id=".$FORM['id']);
}
 else
{
	$location = new Location($FORM['id']);
	$location->untag($FORM['tag_id']);
	
	if(isset($FORM['ajax']))
	{	
		$smarty->assign('tags', $location->tags);
		$smarty->assign('form', $FORM);
		$smarty->display('_taglist.tpl'); 
		exit;
	}
	
	header("Location: editlisting.php?id=".$location->id);
}

?>