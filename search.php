<?php
include_once('includes/config.php');

$selected_tags = (is_array($FORM['selected_tags'])) ? $FORM['selected_tags'] : array();

$smarty->assign("pageTitle", 'Search All Apartments for Rent in Bloomington');

// Require bedrooms and location
$ok_to_search = false;

if($FORM['action']<> '')
{
	if(ereg('^[0-7]$',$FORM['space_bedrooms'])!== false)
	{	$ok_to_search = true; }
	else
	{
		$messages[] = "How many bedrooms do you want?";
		//$ok_to_search = false;
	}
	
}
	
if($ok_to_search)
{
	$smarty->assign('search_performed', true);
	
	$coords = ($FORM['search_location']) ? explode(',', $FORM['search_location']) : $CONFIG['btown_center_lat'].','.$CONFIG['btown_center_lon'];
	$search_lat = $coords[0];
	$search_lon = $coords[1];
	
	$sort_by = (in_array($FORM['sort_order'], array('distance ASC', 'rent ASC'))) ? $FORM['sort_order'] : 'distance ASC';
	
	$sql = "SELECT l.id as location_id, l.name, l.address, s.id as space_id, s.bedrooms, s.bathrooms, s.rent, l.latitude, l.longitude, ((ACOS(SIN(".$search_lat." * PI() / 180) * SIN(l.`latitude` * PI() / 180) + COS(".$search_lat." * PI() / 180) * COS(l.`latitude` * PI() / 180) * COS((".$search_lon." - l.`longitude`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) as distance "
		." FROM `locations` as l, `spaces` as s "
		." WHERE "
			."	   l.`id`=s.`location_id` "
			." AND l.latitude > 0 "
			." AND s.`available`>0 ";
	foreach($selected_tags as $tag_id=>$true)
	{
		$sql .= " AND EXISTS "
				." (SELECT * FROM tag_links as tl "
					."WHERE ("
						."(tl.`tag_to_type`='Space' AND tl.`tag_to_id`=s.`id`)"
						." OR "
						."(tl.`tag_to_type`='Location' AND tl.`tag_to_id`=l.`id`))"
						." AND tl.`tag_id`='".$tag_id."' "
				." ) ";
	}
	$sql .= ($FORM['space_bedrooms']!='') ? " AND s.`bedrooms`='".$FORM['space_bedrooms']."' " : '' ;
	$sql .= ($FORM['location_type']<>'anything') ? " AND l.`type`='".$FORM['location_type']."' " : '' ;
	$sql .= ($FORM['space_bathrooms']>0) ? " AND s.`bathrooms`>='".$FORM['space_bathrooms']."' " : '' ;
	$sql .= ($FORM['space_rent_min']>0) ? " AND s.`rent`>='".$FORM['space_rent_min']."' " : '' ;
	$sql .= ($FORM['space_rent_max']>0) ? " AND s.`rent`<='".$FORM['space_rent_max']."' " : '' ;
	$sql .= " ORDER BY $sort_by LIMIT 15";
	
	$db->Run($sql);
	
	$rows = $db->FetchRowSet();
	$num_results = $db->NumRows();
	$results = array();
	
	if($num_results>0)
	{
		foreach($rows as $row)
		{	
			$sql = "SELECT * FROM `photos` "
				."WHERE `for_type`='Location' "
				  ."AND `for_id`='".$row['location_id']."' "
				  ."AND `visible`='1' "
				."ORDER BY RAND() LIMIT 1";
			$result = $db->Run($sql);
			$photo = $db->FetchRow($result);
				
			$space = new Space($row['space_id']);
			$row['tags'] = $space->get_family_tags();
			$row['json'] = urlencode(json_encode($row));
			$row['address'] = ucwords(strtolower($row['address']));
			$row['photo_id'] = $photo['id'];
			$row['br_string'] = ($row['bedrooms']==0) ? 'Studio' : $row['bedrooms']."-bedroom";
			$row['rent_per_bedroom'] = round($row['rent']/($row['bedrooms']==0?1:$row['bedrooms']));
			$row['distance'] = round($row['distance'], 2);
			$results[] = $row;
		}
	}
	
	$smarty->assign('results', $results);
	$smarty->assign('num_results', $num_results );
	
	if($num_results==0)
		$messages[] = "No listings matched exactly what you were looking for";
}

$smarty->assign("amenities", $AllTags->to_array());
$smarty->assign('search_types', $CONFIG['search_types']);
$smarty->assign('search_location', $FORM['search_location']);
$smarty->assign('form', $FORM);
$smarty->assign('selected_tags', $selected_tags);
$smarty->assign("body", $smarty->fetch("search_form.tpl"));
$smarty->display("index.tpl");	
?>