<?php
include_once('includes/config.php');

$smarty->assign("pageTitle", 'Log Into Your Account');
if($User === false)
{
	$smarty->assign('forward_to', $FORM['forward_to']);
	$smarty->assign('email', $FORM['email']);
	$smarty->assign('wrong_creds', true);
	$smarty->assign('body', $smarty->fetch('login.tpl'));
	$smarty->display('index.tpl');
	exit;
	
}
 else
{
	$_SESSION['user_id'] = $User->id;
	$_SESSION['messages'][] = 'Logged in and ready, welcome back!';
	
	$FORM['forward_to'] = ($FORM['forward']<>'') ? $FORM['forward'] : $FORM['forward_to'];
	$forward_to = ($FORM['forward_to']=='') ? 'welcome.php' : str_replace('&amp;','&', strtolower($FORM['forward_to']));
	header("Location: $forward_to");
	
	exit;
}
?>