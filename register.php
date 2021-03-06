<?php

include_once('includes/config.php');

$FORM['type'] = (!isset($FORM['type'])) ? 'student' : $FORM['type'];

$smarty->assign("pageTitle", 'Sign Up');
$smarty->assign('first_name', $FORM['first_name']);
$smarty->assign('last_name', $FORM['last_name']);
$smarty->assign('email', $FORM['email']);
$smarty->assign('company', $FORM['company']);
$smarty->assign('phone', $FORM['phone']);
$smarty->assign('type', $FORM['type']);

if($FORM['action']=='')
{	
	if($FORM['ajax'])
	{
		$smarty->display("register_ajax.tpl");
	}
	 else
	{
		$smarty->assign("body", $smarty->fetch("register.tpl"));
		$smarty->display("index.tpl");	
	}
	exit;
}
 else
{
	if(!$User)
	{
		if(!ValidEmail($FORM['email'])){
			$messages[] = 'You need a valid email address.';
			$smarty->assign('email', ''); 
		}
		
		if($AllUsers->find_by_email($FORM['email']) !== false){
			$messages[] = "'".$FORM['email']."' is already registered. Want to <a href='welcome.php'>log in?</a>";
			$smarty->assign('email', '');
		}
		
		if($FORM['pass'] <> $FORM['confirm_pass'] OR $FORM['pass']=='')
			$messages[] = 'Please enter two matching passwords.';
		
		if(is_array($messages)){
			$smarty->assign("body", $smarty->fetch("register.tpl"));
			$smarty->display("index.tpl");	
			exit;
		}
		
		$User = $AllUsers->new_from_form($FORM);
		
		$_SESSION['user_id'] = $User->id;
	}
	
	if($FORM['forward']<>'')
	{	
		$FORM['forward'] = eregi_replace('[^a-z0-9\._\=\?\&]','',$FORM['forward']);
		
		if($FORM['ajax'])
			die("GOTO ".$FORM['forward']);
		
		header("Location: ".$FORM['forward']);
	}
	 else
	{	
		if($FORM['ajax'])
			die("CLOSE");
			
		header("Location: welcome.php");	
	}
}

?>