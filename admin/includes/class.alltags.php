<?php

class AllTags
{
	function apply_tag($target, $tag)
	{
		global $db;	
		
		$type = get_class($target);
		if($type===false)
			return false;
			
		if($target->is_tagged_with($tag))
			return true;
		
		$tag = $this->create_or_find_by_text($tag);
		
		$sql = "INSERT INTO `tag_links` "
			."(`tag_id`, `tag_to_type`, `tag_to_id`) VALUES "
			."('".$tag->id."', '$type', '".$target->id."')";
		$db->Run($sql);
		
		return true;
	}
	
	function create_or_find_by_text($text)
	{
		global $db;	
		
		$sql = "SELECT * FROM `tags` WHERE `text`='$text'";
		$db->Run($sql);
		
		if($db->NumRows()==0)
		{
			$tag = $this->new_tag($text);
		} 
		 else
		{
			$row = $db->FetchRow();
			$tag = new Tag($row['id']);
		}
		
		return $tag;
	}
	
	function new_tag($text)
	{
		global $db;	
		
		$sql = "INSERT INTO `tags` (`text`) VALUES ('$text')";
		$db->Run($sql);
		
		$id = $db->RowID();
		
		return new Tag($id);
	}
	
	function delete_tag($tag)
	{
		global $db;	
		
		if(is_string($tag))
		{
			$tag = $this->create_or_find_by_text($tag);
		}
		
		if(get_class($tag) <> 'Tag')
			return false;
			
		$sql = "DELETE FROM `tags` WHERE `id`='".$tag->id."'";
		$db->Run($sql);
	}
	
	function objectify($tag)
	{
		global $db;	
		
		if(get_class($tag)=='Tag')
		{
			return true;
		}
		 elseif(is_numeric($tag))
		{
			return new Tag($tag);
		}
		 elseif(is_string($tag))
		{
			return $this->create_or_find_by_text($tag);
		}
		
		return false;
	}
	
	function to_array( $at_least=2 )
	{
		global $db; 
		
		$sql = "SELECT t.*, COUNT(tl.`tag_to_id`) FROM `tag_links` as tl, `tags` as t WHERE t.`id`=tl.`tag_id` ";
		if($at_least_5)
			$sql .= " AND COUNT(`tag_to_id`) >= 5 ";
		$sql .= " GROUP BY tl.tag_id ORDER BY t.`text` ASC ";
		$db->Run($sql);
		
		return $db->FetchRowSet();
	}
	
}

?>