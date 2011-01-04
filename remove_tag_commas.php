<?php

include_once('includes/config.php');

$tags = $AllTags->to_array(false);

foreach($tags as $tag)
{
	if(strpos($tag['text'], ',') !== false)
	{
		$sql = "SELECT `tag_to_type`, `tag_to_id` FROM `tag_links` WHERE `tag_id`='".$tag['id']."'";
		$result = $db->Run($sql);
		$tagged_objs = $db->FetchRowSet($result);
		
		$real_tags = explode( ',' , $tag['text']);
		
		foreach($tagged_objs as $obj)
		{
			$obj = ($obj['tag_to_type']=='Space') ? new Space($obj['tag_to_id']) : new Location($obj['tag_to_id']);
			$obj->untag($tag['text']);
			
			foreach($real_tags as $real_tag)
			{
				$obj->tag_with($real_tag);
			}
		}
	}
}

?>
