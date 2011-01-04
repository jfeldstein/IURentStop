<?php
$require_login = true;
include_once('includes/config.php');

if($FORM['action']=='Save' || $FORM['action'] == 'Update')
{
	$User->save_from_form($FORM);
	if($FORM['forward'])
	{
		$_SESSION['messages'][] = 'Your account has been updated';
		header('Location: '.$FORM['forward']);
		exit;
	}
	 else
	{	$messages[] = 'Your account has been updated'; }
}
 elseif($FORM['action']=='Change Password')
{
	if(md5($FORM['cur_pass']) == $User->passhash)
	{
		if($FORM['new_pass']==$FORM['con_pass'])
		{
			$User->setPassword($FORM['new_pass']);
			$messages[] = "Your password has been changed";
		}
		 else
		{
			$messages[] = "The two passwords didn't match";
		}
	}
	 else
	{
		$messages[] = "You entered your current password incorrectly";
	}
}
 elseif($FORM['action']=='Change to Student')
{
	$User->set_type('student');
	$_SESSION['messages'][] = "You're now using a student account.";
	header('Location: welcome.php');
	exit;
}
 elseif($FORM['action']=='Change to Property Owner')
{
	$User->set_type('owner');
	$_SESSION['messages'][] = "You're now using a property owner's account.";
	header('Location: welcome.php');
	exit;
}

$smarty->assign('user', $User->to_array());

$smarty->assign("pageTitle", 'Edit Your Account');
$smarty->assign("body", $smarty->fetch("editaccount_form.tpl"));
$smarty->display("index.tpl");	
?>