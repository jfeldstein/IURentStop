<?php

class Location extends Thing
{
	var $id;
	var $name;
	var $address;
	var $belongs_to_user_id;
	var $type;
	var $spaces = array();
	var $error;
	var $latitude;
	var $longitude;
	var $units;
	
	function Location( $id )
	{
			
		global $db;	
		
		$sql = "SELECT * FROM `locations` WHERE `id`='$id'";
		$result = $db->Run($sql);
		
		if($db->NumRows($result) == 0)
		{
			$this->id = -1;
			return false;
		}
			
		$tmp = $db->FetchRow($result);
		$this->id		= $tmp['id'];
		$this->name 	= $tmp['name'];
		$this->address	= $tmp['address'];
		$this->type 	= $tmp['type'];
		$this->belongs_to_user_id = $tmp['user_id'];
		$this->spaces 	= $this->get_spaces();
		$this->tags			= $this->get_tags();
		$this->latitude		= $tmp['latitude'];
		$this->longitude	= $tmp['longitude'];
		$this->all_photos	= $this->get_photos();
		$this->visible_photos=$this->get_visible_photos();
		$this->units 	=$tmp['units'];
		
		return true;
	}
	
	private function get_spaces()
	{
		global $db;	
		
		$sql = "SELECT * FROM `spaces` WHERE `location_id`='".$this->id."' ORDER BY `bedrooms` ASC, `bathrooms` ASC";
		$rows = $db->FetchRowSet($db->Run($sql));
		
		$spaces = array();
		
		if(count($rows))
		{
			foreach($rows as $space_row)
			{ 
				$space = new Space($space_row['id']);
				$spaces[] = $space->to_array();
			}
		}
		
		return $spaces;
	}
	
	function new_space_from_form(&$FORM)
	{
		global $db;	
		
		$sql = "INSERT INTO `spaces` "
			." (`available`, `bedrooms`, `bathrooms`, `rent`, `location_id`) "
			." VALUES "
			." ('".$FORM['space_available']."', '".$FORM['space_bedrooms']."', '".$FORM['space_bathrooms']."', '".$FORM['space_rent']."', '" . $this->id . "');";
		$result = $db->Run($sql);
		$id = $db->RowID();
		
		$space = new Space($id);
		
		return $space;
	}
	
	function to_array()
	{
		$array['id'] 		= $this->id;
		$array['name'] 		= $this->name;
		$array['address'] 	= $this->address;
		$array['type'] 		= $this->type;
		$array['belongs_to_user_id'] = $this->belongs_to_user_id;
		$array['spaces'] 	= $this->spaces;
		$array['num_spaces']= count($this->spaces);
		$array['tags']		= $this->tags;
		$array['latitude']	= $this->latitude;
		$array['longitude']	= $this->longitude;
		$array['all_photos']= $this->all_photos;
		$array['visible_photos']	= $this->visible_photos;
		
		return $array;
	}
	
	function save_from_form($FORM) 
	{
		global $db;	
			
		$coords = $this->get_coords($FORM['location_address']);
		if($coords===false)
			return false;
		
		$sql = "UPDATE `locations` SET "
				." `name`	= '" . $FORM['location_name'] . "', "
				." `address`= '" . $FORM['location_address'] . "', "
				." `latitude`	= '" . $coords['latitude'] . "', "
				." `longitude`	= '" . $coords['longitude'] . "' "
			." WHERE `id`='" .$this->id."'";
		$db->Run($sql);
		
		$this->name = $FORM['location_name'];
		$this->address = $FORM['location_address'];
		$this->latitude = $FORM['latitude'];
		$this->longitude = $FORM['longitude'];
		
		return true;
	}
	
	function get_coords($q=false)
	{
		global $CONFIG;
		
		if(!$q)
		{ $q = $this->address; }
		
		$q 		= urlencode($q.', Bloomington, Indiana');
		$key 	= $CONFIG['google_key'];
		
		$fs 	= fopen("http://maps.google.com/maps/geo?q=$q&key=$key&output=csv", 'r');
		$csv 	= fgets($fs, 999);
		$values = explode(',', $csv);
		
		$coords = array(
			'latitude'=> $values[2],
			'longitude'=> $values[3]);
		
		if($coords['latitude']==0 || $coords['longitude']==0)
		{
			$_SESSION['messages'][] = "The address '".$q."' could not be located in Bloomington.";
			$_SESSION['messages'][] = "See the <a href='faq.php#nogeocode'>help page</a> for more information.";
		}
		 else
		{
			return $coords;
		}
	}
	
	function delete()
	{		
		// This should also delete tags, and photos of the location
		
		
		global $db;	
		
		$spaces = $this->spaces;
		foreach($spaces as $space)
		{
			$space = new Space($space['id']);
			$this->delete_space($space);
		}
		
		$sql = "DELETE FROM `locations` WHERE `id`='".$this->id."'";
		$db->Run($sql);
		
		$this->spaces = array();
		$this->id = 0;
	}
	
	function delete_space($space)
	{
		global $db;	
		
		$space = (get_class($space)=='Space') ? $space : new Space($space);
		foreach($space->tags as $tag)
		{
			$space->untag($tag['id']);
		}
		
		$sql = "DELETE FROM `spaces` WHERE `id`='".$space->id."'";
		$db->Run($sql);
		
		$this->spaces = $this->get_spaces();
		
		return true;
	}
}

?>