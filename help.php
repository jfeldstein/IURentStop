<?php
include_once('includes/config.php');

$smarty->assign("pageTitle", 'Contact Us');
if($FORM['action']<>'')
{
	if(!eregi($CONFIG['email_regex'], $FORM['from']) OR $FORM['from']==''){
		$messages[] = 'You need a valid email address.';
	}
	
	if($FORM['subject']==''){
		$FORM['subject'] = "Email from help form";
	}
	
	if($FORM['body']==''){
		$messages[] = "What message should I send?";
	}
	 
	if(!isset($messages))
	{
		$mail->From     = $FORM['from'];
		$mail->FromName = $FORM['name'];
		
	    $mail->Body    = str_replace("\n","<br>",$FORM['body'].'<br>'.$FORM['from_page']);
	    $mail->AltBody = $FORM['body'];
		$mail->Subject = $FORM['subject'];
	    $mail->AddAddress("Jordan@IURentStop.com", "Jordan Feldstein");
		
		if($mail->Send()){
			$messages[] = "Thanks for letting us know. Your email's been sent.";
			$smarty->assign('form', array());
		} else {
			$messages[] = "Oops... There was a server error that stopped your email from being sent.";
			$messages[] = "Please send it manually to Jordan@iurentstop.com so we can fix this.";
			$smarty->assign('form', $FORM);
		}
	}
	 else
	{
		$smarty->assign('form', $FORM);
	}
}


$smarty->assign("from_page", $_SERVER['referrer']);
$smarty->assign("body", $smarty->fetch("help.tpl"));
$smarty->display("index.tpl");	
?>