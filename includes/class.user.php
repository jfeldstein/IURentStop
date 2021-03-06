<?php
class User
{
	
	var $id=-1;
	var $first_name;
	var $last_name;
	var $full_name;
	var $top_name;
	var $email;
	var $phone;
	var $company;
	var $passhash;
	var $locations = array();
	var $num_photo_credits;
	var $num_photo_credits_used;
	var $complete_contact;
	var $starred_spaces;
	var $token;
	var $token_time;
	var $tools = array();
	var $type;
	
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
		$this->full_name	= ucwords(strtolower($this->first_name.' '.$this->last_name));
		$this->email		= $tmp['email'];
		$this->passhash		= $tmp['passhash'];
		$this->phone		= $tmp['phone'];
		$this->company		= ucwords(strtolower($tmp['company']));
		$this->token		= $tmp['token'];
		$this->token_time	= $tmp['token_time'];
		$this->top_name		= ($this->company<>'') ? $this->company : $this->full_name;
		$this->complete_contact	= ($this->first_name && $this->phone) ? true : false;
		$this->type			= $tmp['type'];
		$this->starred_spaces	= array();
		
		$this->locations = $this->get_locations();
		
		$sql = "SELECT * FROM tools WHERE user_id='".$this->id."'";
		$result = $db->Run($sql);
		foreach($db->FetchRowSet($result) as $tool){
			$this->tools[$tool['tool']] = $tool['tool'];
		}
		
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
			if($usedPhotos[$tmp['for_type'].$tmp['for_id']]>=2)
				$countedPhotos[] = $photo;
			$usedPhotos[$tmp['for_type'].$tmp['for_id']]++;
		}
		$this->num_photo_credits_used = count($countedPhotos);
		
		
		$sql = "SELECT * FROM `starred_spaces` "
			  ."WHERE `user_id`='".$this->id."'";
		$tmp = $db->FetchRowSet($db->Run($sql));
		$this->starred_spaces = array();
		if(count($tmp))
		{	foreach($tmp as $save)
			{
				$this->starred_spaces[] = $save['space_id'];
		}	}
		return true;
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
	
	function makeNewToken()
	{
		global $db;
		
		$this->token 	= md5($this->email.$this->full_name.time());
		$this->tokenTime= time();
		
		$sql = "UPDATE `users` "
			."SET `token`='".$this->token."', "
				."`token_time`='".$this->tokenTime."' "
			."WHERE `id`='".$this->id."'";
		$db->Run($sql);
		
		return $this->token;
	}
	
	function save_from_form($FORM)
	{
		global $db;	
		
		$this->first_name = $FORM['first_name'];
		$this->last_name = $FORM['last_name'];
		$this->email = ($FORM['email']) ? $FORM['email'] : $this->email;
		$this->phone = ereg_replace('[^0-9]', '', $FORM['phone']);
		$this->company = $FORM['company'];
		
		$this->phone = (substr($this->phone,0,1)=='1') ? substr($this->phone,1) : $this->phone;
		
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

	function star_space( $space )
	{	
		global $db;	
		
		if(get_class($space) <> 'Space')
		{
			$space = new Space($space);
			if($space->id ==-1 OR $space === false)
				return false;
		}
		$space_id = $space->id;
		
		if(in_array($space_id, $this->starred_spaces))
			exit("PRESAVED"); // SHould Throw
		
		$sql = "INSERT INTO `starred_spaces` "
			."(`space_id`, `user_id`, `date`) VALUES "
			."('$space_id', '".$this->id."', '".time()."')";
		$db->Run($sql);
	}
	
	function set_type($type)
	{	
		global $db, $CONFIG;
		
		if(!in_array($type, $CONFIG['allowed_account_types']))
			return false; // Should throw exception
		
		$sql = "UPDATE `users` SET `type`='$type' WHERE `id`='".$this->id."'";
		$db->Run($sql);
	}
	
	function setPassword($pass)
	{
		global $db;
		
		$sql = "UPDATE `users` "
			."SET `passhash`='".md5($pass)."', "
				."`token`='', `token_time`='' "
			."WHERE `id`='".$this->id."'";
		$db->Run($sql);
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
		$array['num_photo_credits'] = $this->num_photo_credits;
		$array['num_photo_credits_used'] = $this->num_photo_credits_used;
		$array['complete_contact'] = $this->complete_contact;
		$array['starred_spaces'] = $this->starred_spaces;
		$array['type'] = $this->type;
		$array['tools'] = $this->tools;
		
		return $array;
	}
	
	function unstar_space( $space )
	{
		global $db;	
		
		$space_id = (get_class($space) <> 'Space') ? $space : $space->id;
		
		$sql = "DELETE FROM `starred_spaces` "
			  ."WHERE `space_id`='$space_id' "
			    ."AND `user_id`='".$this->id."'";
		$db->Run($sql);
	}
	
	function enable_tool($tool){
		global $db;
		
		$this->disable_tool($tool);
		
		$sql = "INSERT INTO tools (`user_id`, `tool`) VALUES ('".$this->id."', '$tool')";
		$db->Run($sql);
		
		$this->tools[$tool] = $tool;
	}
	
	function disable_tool($tool) {
		
		global $db;
		
		$sql = "DELETE FROM tools WHERE user_id='".$this->id."' AND tool='$tool'";
		$db->Run($sql);
		
		unset($this->tools[$tool]);
	}
}

?>