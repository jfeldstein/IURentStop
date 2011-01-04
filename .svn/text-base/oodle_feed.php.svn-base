<?php

include_once('includes/config.php');

$listings_rows = $AllSpaces->using_oodle();

foreach($listings_rows as $row){
	
	$item = array(
		'description' => $row['bedrooms'].'-Bedroom '.$row['type'].' for $'.$row['rent'],
		'link' => 'http://www.iurentstop.com/viewlisting.php?id='.$row['space_id'].'&from=oodle',
		'listing_type' => 'for rent',
		'lat'	=> $row['latitude'],
		'lon'	=> $row['longitude'],
		'price' => $row['price'],
		'title' => $row['bedrooms'].'-Bedroom '.$row['type'].' for $'.$row['rent'],
		'bathrooms' => $row['bathrooms'],
		'bedrooms' => $row['bedrooms'],
		'id' => $row['id'],
		'image_link' => 'http://www.iurentstop.com/photos/small/'.$row['photo_id'].'.jpg',
		'property_type' => $row['type'],
		'area' => $row['sq_footage'].' sq feet',
		'amenities_list' => $row['amenities_list']
	);
	$smarty->assign('item', $item);
	$items_string .= $smarty->fetch('google_base_item.tpl');
}

$smarty->assign('items', $items_string);
$smarty->display('google_base_feed.tpl');

?>
