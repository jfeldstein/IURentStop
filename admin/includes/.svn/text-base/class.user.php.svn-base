<?php
class User
{
	
	var $id;
	var $first_name;
	var $last_name;
	var $full_name;
	var $top_name;
	var $email;
	var $phone;
	var $company;
	var $locations = array();
	var $num_photo_credits;
	var $num_photo_credits_used;
	
	function User($id)
	{
		global $db;	
		
		$sql = "SELECT * FROM `users` WHERE `id`='$id'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result) == 0)
			return false;
		
		$tmp = $db->FetchRow($result);
		
		$this->id 			= $tmp['id'];
		$this->first_name	= $tmp['first_name'];
		$this->last_name	= $tmp['last_name'];
		$this->full_name	= $this->first_name.' '.$this->last_name;
		$this->email		= $tmp['email'];
		$this->phone		= $tmp['phone'];
		$this->company		= $tmp['company'];
		$this->top_name		= ($this->company<>'') ? $this->company : $this->full_name;
		
		$this->locations = $this->get_locations();
		
		$sql = "SELECT credits FROM photo_credits "
				."WHERE user_id='".$this->id."' "
				  ."AND year='".date('Y')."' "
				  ."AND month='".date('n')."' ";
		$db->Run($sql);
		if($db->NumRows()>0)
		{
			$row = $db->FetchRow();
			$this->num_photo_credits = $row['credits'];
		}
		 else
		{	$this->num_photo_credits = 0; }
		
		// Can we do this in on query?
		$sql = "SELECT * FROM `photos` as op "
			  ."WHERE EXISTS ("
				."SELECT * FROM `photos` "
				."WHERE photos.for_type=op.for_type "
				  ."AND photos.for_id=op.for_id "
				  ."AND photos.id!=op.id "
				  ."AND photos.visible='1') "
				."AND op.visible='1' "
			  ."ORDER BY op.for_type, op.for_id ";
		$tmp = $db->FetchRowSet($db->Run($sql));
		foreach($tmp as $photo)
		{
			if($last_type == $photo['for_type'] AND $last_id == $photo['for_id'])
				$countedPhotos[] = $photo;
			$last_type = $photo['for_type'];
			$last_id = $photo['for_id'];
		}
		$this->num_photo_credits_used = count($countedPhotos);
		
		return true;
	}
	
	function delete()
	{
		global $db;	
		
		$locations = $this->locations;
		if(count($locations)>0){
			foreach($locations as $loc)
			{
				$loc = new Location($loc['id']);
				$loc->delete();
			}
		}
		
		$sql = "DELETE FROM `users` WHERE `id`='".$this->id."'";
		$db->Run($sql);
		
		$this->locations = array();
		$this->id = 0;
	}
	
	function get_locations()
	{
		global $db;	
		
		$locations = array();
		
		$sql = "SELECT * FROM `locations` WHERE `user_id`='".$this->id."' ORDER BY `address` ASC";
		$rows = $db->FetchRowSet($db->Run($sql));
		
		if(count($rows))
		{
			foreach($rows as $key=>$row)
			{	$sortme[$key] = substr($row['address'], strpos($row['address'],' ')); }
			
			asort($sortme);
			
			foreach($sortme as $key=>$val)
			{	$sorted_rows[] = $rows[$key]; }
			
			foreach($sorted_rows as $loc_row)
			{ 
				$location = new Location($loc_row['id']);
				$locations[] = $location->to_array();
			}
		}
		
		return $locations;
	}
	
	function to_array()
	{
		$array['id'] = $this->id;
		$array['first_name'] = $this->first_name;
		$array['last_name'] = $this->last_name;
		$array['full_name'] = $this->full_name;
		$array['email'] = $this->email;
		$array['phone'] = $this->phone;
		$array['company'] = $this->company;
		$array['top_name'] = $this->top_name;
		$array['locations'] = $this->locations;
		$array['num_locations'] = count($this->locations);
		$array['num_photo_credits'] = $this->num_photo_credits;
		$array['num_photo_credits_used'] = $this->num_photo_credits_used;
		
		return $array;
	}
	
	function save_from_form($FORM)
	{
		global $db;	
		
		$this->first_name = $FORM['first_name'];
		$this->last_name = $FORM['last_name'];
		$this->email = $FORM['email'];
		$this->phone = ereg_replace('[^0-9]', '', $FORM['phone']);
		$this->company = $FORM['company'];
		
		$sql = "UPDATE `users` SET "
				." `first_name`='".$this->first_name."', "
				." `last_name`='".$this->last_name."', "
				." `email`='".$this->email."', "
				." `phone`='".$this->phone."', "
				." `company`='".$this->company."' "
			." WHERE `id`='".$this->id."'";
		$db->Run($sql);
		
		return true;
	}
}

?>