<?php
class AllLocations
{
	
	function new_from_form($FORM)
	{
		global $db;	
			
		$sql = "INSERT INTO `locations` "
			." (`name`, `address`, `type`, `user_id`) "
			." VALUES "
			." ('".$FORM['location_name']."', '".$FORM['location_address']."', '".$FORM['location_type']."', '" . $_SESSION['user_id'] . "');";
		$result = $db->Run($sql);
		$id = $db->RowID();
		
		$location = new Location($id);
		$location->save_from_form($FORM);
		
		return $location;
	}
	
	function find_by_address($email)
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
	
}

?>