<pre><?php

include_once('includes/config.php');

// About the center of campus
$lat1 = 39.171993;
$lon1 = -86.517334;

foreach($AllUsers->list_owners() as $owner){
	$owner = new User($owner['id']);
	$locations = $owner->locations;
	
		if(ereg('^[0-9]{10}$',$owner->phone) === false)
			$owner->delete();;
			
		if(count($owner->locations)==0)
			$owner->delete();
			
	foreach($locations as $loc){
		$total_locs++;
		
		$lat2 = $loc['latitude'];
		$lon2 = $loc['longitude'];
		
		$d = (3958*3.1415926*sqrt(($lat2-$lat1)*($lat2-$lat1) + cos($lat2/57.29578)*cos($lat1/57.29578)*($lon2-$lon1)*($lon2-$lon1))/180);
		
		if($d > 3)
		{	
			$loc = new Location($loc['id']);
			$loc->delete();
		}elseif($loc['type']=='house')
		{	
			$loc = new Location($loc['id']);
			$loc->delete();
		}
	}

	if(count($owner->get_locations()) == 0)
		$owner->delete();
}

echo "\n Total Locations: $total_locs";
?>