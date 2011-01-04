<?php

class Space extends Thing
{
	var $belongs_to_location_id;
	var $id;
	var $bedrooms;
	var $bathrooms;
	var $available;
	var $rent;
	
	function Space( $id )
	{
		global $db;	
		
		$sql = "SELECT * FROM `spaces` WHERE `id`='$id'";
		$tmp = $db->FetchRow($db->Run($sql));
		
		if($db->NumRows($result) == 0)
			return false;
		
		$this->id			 = $tmp['id'];
		$this->belongs_to_location_id = $tmp['location_id'];
		$this->bedrooms		 = $tmp['bedrooms'];
		$this->bathrooms	 = $tmp['bathrooms'];
		$this->available 	 = $tmp['available'];
		$this->rent 		 = $tmp['rent'];
		$this->tags			 = $this->get_tags();
		$this->all_photos	 = $this->get_photos();
		$this->visible_photos=$this->get_listing_photos();
		$this->all_floorplans= $this->get_floorplans();
		$this->visible_floorplans	=$this->get_visible_floorplans();
		
		return true;
	}
	
	function to_array()
	{
		$array['id']			 = $this->id;
		$array['bedrooms']		 = $this->bedrooms;
		$array['bathrooms']		 = $this->bathrooms;
		$array['available']		 = $this->available;
		$array['rent']			 = $this->rent;
		$array['tags']			 = $this->tags;
		$array['family_tags']	 = $this->get_family_tags();
		$array['all_photos']	 = $this->all_photos;
		$array['visible_photos'] = $this->visible_photos;
		$array['all_floorplans'] = $this->all_floorplans;
		$array['visible_floorplans']	= $this->visible_floorplans;
		
		return $array;
	}
	
	function save_from_form($FORM) 
	{
		global $db;	
		
		$location = new Location($this->belongs_to_location_id);
		
		if($_SESSION['user_id'] != $location->belongs_to_user_id)
			return false;
			
		if($FORM['space_rent']/$FORM['space_bedrooms']<340)
			$_SESSION['messages'][] = "Remember: The rent you enter here is for the entire lease.<BR> We'll show the 'per bedroom' rent on listings for you";
			
		$sql = "UPDATE `spaces` SET "
				." `bedrooms`	= '" . $FORM['space_bedrooms'] . "', "
				." `bathrooms`= '" . $FORM['space_bathrooms'] . "', "
				." `available`	= '" . $FORM['space_available'] . "', "
				." `rent`	= '" . $FORM['space_rent'] . "' "
			." WHERE `id`='" .$this->id."'";
		$db->Run($sql);
	}
	
	function delete()
	{
		$location = new Location($this->belongs_to_location_id);
		return $location->delete_space($this);
	}
	
	function get_family_tags()
	{
		global $db;	
		
		$sql = "SELECT t.`id`, t.`text` FROM `tag_links` as tl, `tags` as t WHERE "
			." tl.`tag_to_type`='Location' AND "
			." tl.`tag_to_id`='".$this->belongs_to_location_id."' AND "
			." t.`id`=tl.`tag_id` "
			." ORDER BY t.text ASC";
		$db->Run($sql);
		
		$rows = $db->FetchRowSet();
		
		$location_tags = array();
		foreach($rows as $row)
		{ $location_tags[] = $row; }
		
		return array_merge($location_tags, $this->tags);
	}
	
	function add_floorplan($floorplan)
	{
		global $CONFIG, $db, $FORM;
		
		$src 	= $floorplan['tmp_name'];
		
		if(!@getimagesize($src))
			return "That doesn't seem to be a floorplan.";
			
		$small	= @resize_image($src, '.gif', $CONFIG['floorplan_size_small']);
		$med	= @resize_image($src, '.gif', $CONFIG['floorplan_size_med']);
		$large	= @resize_image($src, '.gif', $CONFIG['floorplan_size_large']);
		
		if($small && $med && $large)
		{
			$caption = ($FORM['caption']=='') ? basename($floorplan['name']) : $FORM['caption'];
			$sql = "INSERT INTO `floorplans` (`caption`, `space_id`, `visible`) "
				." VALUES "
				."('".$caption."','".$FORM['target_id']."', true)";
			if(!$db->Run($sql))
				return "Server Error: Database didn't accept new floorplan";
			
			$floorplan_id = $db->RowID();
			
			@imagejpeg($small,"floorplans/small/$floorplan_id.jpg") OR die("Server Error: Unable to save floorplan thumbnail");
			@imagejpeg($med,"floorplans/med/$floorplan_id.jpg") OR die("Server Error: Unable to save medium size floorplan image");
			@imagejpeg($large,"floorplans/large/$floorplan_id.jpg") OR die("Server Error: Unable to save full size floorplan image");
			
			return true;
		}
		 else
		{	return "There was an error while trying to scale this image."; }
	}
	
	function get_visible_floorplans()
	{	return $this->get_floorplans(true); }
	
	function get_floorplans($onlyVisible = false)
	{
		global $db;
		
		$floorplans	= array();
		
		$sql 	= "SELECT * FROM `floorplans` WHERE `space_id`='".$this->id."'";
		if($onlyVisible)
			$sql .= " AND `visible`='1'";
		$db->Run($sql);
		return $db->FetchRowSet();
	}
}

?>