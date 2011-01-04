<?php

class Thing
{

	var $all_photos;
	var $visible_photos;
	var $listing_photos;
	var $tags = array();
	
	function tag_with($tag)
	{
		global $AllTags;	
		
		$tag = $AllTags->apply_tag($this, $tag); // Applies tag in the database
		
		$this->tags = $this->get_tags();
		
		return $tag;
		
	}
	
	function is_tagged_with($tag)
	{
		global $db, $AllTags;	
		
		$tag = $AllTags->objectify($tag);
		
		if(get_class($tag) <> 'Tag')
			return false;
		
		$sql = "SELECT * FROM `tag_links` WHERE "
			." `tag_id`='".$tag->id."' AND "
			." `tag_to_type`='".get_class($this)."' AND "
			." `tag_to_id`='".$this->id."'";
		$db->Run($sql);
		
		return ($db->NumRows()>0) ? true : false;
	}
	function get_tags()
	{
		global $db;	
		
		$sql = "SELECT t.`id`, t.`text` FROM `tag_links` as tl, `tags` as t WHERE "
			." tl.`tag_to_type`='".get_class($this)."' AND "
			." tl.`tag_to_id`='".$this->id."' AND "
			." t.`id`=tl.`tag_id` "
			." ORDER BY t.text ASC";
		$db->Run($sql);
		
		$rows = $db->FetchRowSet();
		
		$tags = array();
		foreach($rows as $row)
		{	$tags[] = $row; }
		
		return $tags;
	}
	
	function untag($tag)
	{
		global $db, $AllTags;	
			
		$tag = $AllTags->objectify($tag);
		
		if(get_class($tag) <> 'Tag')
			return false;

		$sql = "DELETE FROM `tag_links` WHERE "
			." `tag_to_type`='".get_class($this)."' AND "
			." `tag_to_id`='".$this->id."' AND "
			." `tag_id`='".$tag->id."' ";
		$db->Run($sql);
		
		$this->tags = $this->get_tags();
		
		if($tag->count==1)
		{	$AllTags->delete_tag($tag); }
		
		return true;
	}
	
	function add_photo($photo)
	{
		global $CONFIG, $db, $FORM;
		
		$src 	= $photo['tmp_name'];
		
		if(!@getimagesize($src))
			return "That doesn't seem to be a photo.";
			
		$small	= resize_image($src, '.jpg', $CONFIG['photo_size_small']);
		$med	= resize_image($src, '.jpg', $CONFIG['photo_size_med']);
		$large	= resize_image($src, '.jpg', $CONFIG['photo_size_large']);
		
		if($small && $med && $large)
		{
			$name = ($FORM['caption']=='') ? basename($photo['name']) : $FORM['caption'];
			$sql = "INSERT INTO `photos` (`caption`, `for_type`, `for_id`) "
				." VALUES "
				."('".$name."','".$FORM['target_type']."','".$FORM['target_id']."')";
			if(!$db->Run($sql))
				return "Server Error: Database didn't accept new photo";
			
			$photo_id = $db->RowID();
			
			@imagejpeg($small,"photos/small/$photo_id.jpg") OR die("Server Error: Unable to save small thumbnail");
			@imagejpeg($med,  "photos/med/$photo_id.jpg") OR die("Server Error: Unable to save medium thumbnail");;
			@imagejpeg($large,"photos/large/$photo_id.jpg") OR die("Server Error: Unable to save full size image");;
			
			return true;
		}
		 else
		{	return "There was an error while trying to scale this image."; }
	}
	
	function get_visible_photos()
	{	return $this->get_photos(true); }
	
	function get_listing_photos()
	{	return $this->get_photos(true, true); }
	
	function get_photos($onlyVisible = false, $family = false)
	{
		global $db;
		
		$photos	= array();
		
		$sql 	= "SELECT * FROM `photos` WHERE "
				." (`for_type`='".get_class($this)."' AND "
				." `for_id`='".$this->id."') ";
				
		if(get_class($this)=='Space' && $family)
			$sql .= " OR (`for_type`='Location' AND `for_id`='".$this->belongs_to_location_id."')";
		
		if($onlyVisible)
			$sql .= " AND `visible`='1'";
		$db->Run($sql);
		return $db->FetchRowSet();
	}
}

?>