<?php
include_once('includes/config.php');

$space 		= new Space($FORM['id']);
$location 	= new Location($space->belongs_to_location_id);
$owner 		= new User($location->belongs_to_user_id);

$pageTitle = $location->address;
$pageTitle .=(isset($FORM['realmap'])) ? ' - with map' : '';
$smarty->assign("pageTitle", $pageTitle);

if($space->id==-1 or $location->id==-1)
{
	$_SESSION['messages'][] = "<b>Invalid listing:</b> Try searching to find what you need instead.";
	header("Location: search.php");
	exit;
}

if($User)
{if(in_array($space->id, $User->starred_spaces))
	$smarty->assign('location_is_starred', true);
}

if(count($location->spaces)>1)
{
	$osil = array();
	foreach($location->spaces as $other_space)
	{
		if($other_space['id'] != $FORM['id'])
		{	$osil[] = $other_space; }
	}
}
$smarty->assign('num_osil', count($osil));
$smarty->assign('space', $space->to_array());
$smarty->assign('other_spaces_in_location', $osil);
$smarty->assign('location', $location->to_array());
$smarty->assign('owner', $owner->to_array());

/*if(isset($FORM['withphone']) AND !isset($_SESSION['user_id'])){
	$Computer->log('reg2view', $space->id);
	
	header("Location: register.php?type=student&forward=viewlisting.php%3Fid%3D".$space->id);
}
  else*/
  if(isset($FORM['withphone']) OR isset($FORM['onlyphone']))
{
	setcookie('skip_notice',1);
	$smarty->assign('withphone', true);
	
	$area 		= substr($owner->phone,0,3);
	$exchange 	= substr($owner->phone,3,3);
	$number 	= substr($owner->phone,6,4);
	$smarty->assign('properphone', "($area) $exchange-$number");
	
	$Computer->log('getphone', $space->id);
}
 else
	$Computer->log('viewlisting', $space->id);

if(isset($FORM['onlyphone']))
{ $smarty->display('phone_contact.tpl'); exit; }

$smarty->assign("body", $smarty->fetch("viewlisting.tpl"));
$smarty->display("index.tpl");	
?>
