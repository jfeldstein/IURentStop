<?php

class Tag
{
	var $id;
	var $text;
	var $count;
	
	function Tag($id)
	{
		global $db;	
		
		$sql = "SELECT * FROM `tags` WHERE `id`='$id'";
		$db->Run($sql);
		$tag = $db->FetchRow();
		
		$this->id 	= $tag['id'];
		$this->text = $tag['text'];
		
		$sql = "SELECT COUNT(*) as 'count' FROM `tag_links` WHERE `tag_id`='".$this->id."'";
		$db->Run($sql);
		$row = $db->FetchRow();
		
		$this->count = $row['count'];		
	}
	
	function to_array()
	{
		$array['id'] 	= $this->id;
		$array['text']	= $this->text;
		
		return $array;
	}
}

?>