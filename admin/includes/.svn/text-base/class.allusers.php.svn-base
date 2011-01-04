<?php
class AllUsers
{
	
	function list_owners(){
		global $db;
		
		$sql 	= "SELECT * FROM `users` WHERE `type` LIKE 'owner'";
		$result	= $db->Run($sql);
		$oUsers	= $db->FetchRowSet($result);
		
		foreach($oUsers as $user){
			$oUser		= new User($user['id']); 
			$aUsers[]	= $oUser->to_array();
		} 
		
		return $aUsers;
	}
	
	function new_from_form($FORM)
	{
		global $db;	
		
		$FORM['phone'] = ereg_replace('[^0-9]','',$FORM['phone']);
		
		$sql = "INSERT INTO `users` "
			." (`first_name`, `last_name`, `company`, `email`, `phone`, `passhash`, `type`) "
			." VALUES "
			." ('".$FORM['first_name']."', '".$FORM['last_name']."', '".$FORM['company']."', '".$FORM['email']."', '".$FORM['phone']."', '".md5($FORM['pass'])."', '".$FORM['type']."')";
		$result = $db->Run($sql);
		$id = $db->RowID();
		
		$u = new User($id);
		
		return $u;
	}
	
	function find_by_email($email)
	{
		global $db;	
		
		$sql = "SELECT `id` FROM `users` WHERE `email` LIKE '$email'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result)==0) 
			return false;
			
		$tmp = $db->FetchRow($result);
		
		$u = new User($tmp['id']);
		return $u;
	}
	
	function find_by_phone($phone)
	{
		global $db;	
		
		$sql = "SELECT `id` FROM `users` WHERE `phone` LIKE '$phone'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result)==0) 
			return false;
			
		$tmp = $db->FetchRow($result);
		
		$u = new User($tmp['id']);
		return $u;
	}
	
	function find_by_email_and_passhash($email, $passhash)
	{
		global $db;	
		
		$sql = "SELECT `id` FROM `users` WHERE `email` LIKE '$email' AND `passhash`='$passhash'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result)==0) 
			return false;
			
		$tmp = $db->FetchRow($result);
		
		$u = new User($tmp['id']);
		return $u;
	}
}

?>