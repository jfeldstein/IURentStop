<?php
include_once('includes/config.php');

if(isset($FORM['email']))
{
	if(isset($FORM['token']))
	{	
		$user = $AllUsers->find_by_email($FORM['email']);
		
		if($FORM['token'] == $user->token AND time() < $user->token_time+60*60*2)
		{
			$newpass = substr(md5(time().'pie'),0,7);
			$user->setPassword($newpass);
			$smarty->assign('newpass', $newpass);
			
			// Log you in
			$User = $AllUsers->find_by_email_and_passhash($FORM['email'], md5($newpass));
			$_SESSION['user_id'] = $User->id;
			$smarty->assign('logged_in_as', $User->email);
			$smarty->assign('user', $User->to_array());
		}
		 else
		{	$messages[] = "That token is no longer valid"; }
	}
	 else
	{
		$user = $AllUsers->find_by_email($FORM['email']);
		
		if($user)
		{
			$token = $user->makeNewToken();
			$smarty->assign('token', $token);
			$smarty->assign('email', $user->email);
			
			$mail->From     = 'system@iurentstop.com';
			$mail->FromName = 'NoReply IURentStop';
			
		    $mail->Body    = $smarty->fetch('_password_email.tpl');
			$mail->Subject = "Reset your IURentStop Password";
		    $mail->AddAddress($user->email, $user->full_name);
			
			if(!$mail->Send())
			{	
				$messages[] = "There was an error while sending an email to your account. Please <a href='help.php'>contact support</a>.";
			}
		}
		 else
		{
			$messages[] = "That email isn't in our database. Have you <a href='register.php?email=".$FORM['email']."'>registered</a>?";
		}
	}
}

$smarty->assign('body', $smarty->fetch('password_retrieval.tpl'));
$smarty->display('index.tpl');

?>