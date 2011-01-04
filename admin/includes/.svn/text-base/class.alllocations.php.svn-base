<?php
class AllLocations
{
	
	function new_from_form($FORM)
	{
		// Uses FORM['user_id'] instead of session to allow adding to 3rd party
		global $db;	
			
		$sql = "INSERT INTO `locations` "
			." (`name`, `address`, `type`, `user_id`, `units`) "
			." VALUES "
			." ('".$FORM['location_name']."', '".$FORM['location_address']."', '".$FORM['location_type']."', '" . $FORM['user_id'] . "', '".$FORM['units']."');";
		$result = $db->Run($sql);
		$id = $db->RowID();
		
		$location = new Location($id);
		$location->save_from_form($FORM);
		
		return $location;
	}
	
	
	function find_by_address($address)
	{
		global $db;	
		
		$sql = "SELECT `id` FROM `locations` WHERE `address` LIKE '$address'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result)==0) 
			return false;
			
		$tmp = $db->FetchRow($result);
		
		$l = new Location($tmp['id']);
		return $l;
	}
	
}

?>