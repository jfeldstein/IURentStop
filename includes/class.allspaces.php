<?php
class AllSpaces
{
	function using_google_base(){
		global $db;
		
		$sql = "SELECT l.id as location_id, l.name, l.address, s.id as space_id, s.bedrooms, s.bathrooms, s.rent, l.type "
			." FROM "
				." spaces as s, "
				." locations as l, "
				." users as u, "
				." tools as t "
			." WHERE "
				." s.location_id = l.id AND "
				." u.id = t.user_id AND "
				." t.tool = 'google' AND "
				." s.available > 0 ";
				
		$result = $db->Run($sql);
		$rows = $db->FetchRowSet($result);
		
		foreach($rows as $row)
		{	
			$sql = "SELECT * FROM `photos` "
				."WHERE `for_type`='Location' "
				  ."AND `for_id`='".$row['location_id']."' "
				  ."AND `visible`='1' "
				."ORDER BY RAND() LIMIT 1";
			$result = $db->Run($sql);
			$photo = $db->FetchRow($result);
			
			$row['photo_id'] = $photo['id'];
			
			$results[] = $row;
		}
		
		return $results;
		
	}
	
	function using_oodle(){
		global $db;
		
		$sql = "SELECT l.id as location_id, ;.latitude, l.longitude, l.name, l.address, s.id as space_id, s.bedrooms, s.bathrooms, s.rent, l.type "
			." FROM "
				." spaces as s, "
				." locations as l, "
				." users as u, "
				." tools as t "
			." WHERE "
				." s.location_id = l.id AND "
				." u.id = t.user_id AND "
				." t.tool = 'google' AND "
				." s.available > 0 ";
				
		$result = $db->Run($sql);
		$rows = $db->FetchRowSet($result);
		
		foreach($rows as $row)
		{	
			$sql = "SELECT * FROM `photos` "
				."WHERE `for_type`='Location' "
				  ."AND `for_id`='".$row['location_id']."' "
				  ."AND `visible`='1' "
				."ORDER BY RAND() LIMIT 1";
			$result = $db->Run($sql);
			$photo = $db->FetchRow($result);
			$row['photo_id'] = $photo['id'];
		
			$sql = "SELECT t.text "
				." FROM tags as t, tag_links as tl, locations as l, spaces as s "
				." WHERE "
				." t.id = tl.tag_id AND "
				." ((tl.tag_to_id = l.id AND tl.tag_to_type = 'Location') "
				." OR "
				." (tl.tag_to_id = s.id AND tl.tag_to_type = 'Space')) ";
			$result = $db->Run($sql);
			$tags = $db->FetchRowSet($result);
			foreach($tags as $tag){
				$row['amenities_list'] .= $tag['text'].', ';
			}
			
			
			$results[] = $row;
		}
		
		return $results;
		
	}
}

?>