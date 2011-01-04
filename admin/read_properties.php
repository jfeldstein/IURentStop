<pre><?php

include_once('includes/config.php');
set_time_limit(0);

// SHould be using DB, not files
$source = fopen("./properties.csv", 'r');
$dest 	= fopen("./new_props.csv", "w+");

$unkowns = 0;
$fixed = 0;
$totals = array();
$loc = new Location(0);

function save_this_space($space){
	global $dest, $unkowns, $totals, $loc;
	
	$space[2] = filter_bedrooms($space[2]);
	
	if($space[4] == 'UNKNOWN')
		$unknowns++; 
		
	$totals[$space[2]]++;
	
	fputcsv($dest, $space);
}

function filter_bedrooms($br_string){
	global $fixed;
	
	$old = $br_string;
	
	if(eregi('(ef[a-z]*|studio)', $br_string))
		$br_string = '0';
	$br_string = eregi_replace('^([0-9])\-[a-z]+','\1',$br_string);
	$br_string = eregi_replace('^([0-9]) [a-z]*','\1', $br_string);
	if(eregi('([0-9])(b[a-z]*|ea)', $br_string, $matches))
		$br_string = $matches[1];
	
	$br_string = str_replace('.','', $br_string);
	
	if($old <> $br_string){
		$fixed++;
	}
	return $br_string;
}



while($property = fgetcsv($source)) {
	// 0 - Address
	// 1 - Units
	// 2 - Bedrooms
	// 3 - Unit Type
	// 4 - Owner Name
	// 5 - Owner Address
	// 6 - Owner Phone
	
	//PreProcessing
		$newUser = array();
	//	Clean symbols from phone number
		$newUser['phone']	= ereg_replace('[^0-9]','',$property[6]);
		$newUser['type']	= 'owner';
		
	// 	Is Owner name really the owner's name, or the company's name?
		if(eregi('(llc|, co\.|inc|management)', $property[4]) OR strpos($property[4], ',')===false){
			$newUser['company'] = ucwords($property[4]);
		} else {
			$namebits = explode(',', $property[4]);
			
			$newUser['first_name'] = $namebits[1];
			$newUser['last_name'] = $namebits[0];
		}
	
	
	if(($user = $AllUsers->find_by_phone(eregi_replace('[^0-9]','',$newUser['phone']))) === false)
		$user = $AllUsers->new_from_form($newUser);
	
	$newLocation = array();
	$newLocation['location_address'] = ucwords($property[0]);
	$newLocation['location_type'] = $property[3];
	$newLocation['user_id'] = $user->id;
	
	if(($location = $AllLocations->find_by_address($newLocation['location_address'])) === false)
		$location = $AllLocations->new_from_form($newLocation);
	
	$brClauses = array($property[2]);
	
	// Seperate into individual clauses
	foreach(array('&',';','/',',') as $div){
		$tmp = array();
		foreach($brClauses as $clause){
			$tmp = array_merge($tmp, explode($div, $clause));
		}
		$brClauses = $tmp;
	}

	foreach($brClauses as $clause){
		$newSpace = array();
		$newSpace['space_available'] = '1';
		$newSpace['space_bedrooms'] = filter_bedrooms($property[2]);
		$newSpace['space_bathrooms'] = '';

		$location->new_space_from_form($newSpace);
		
		echo $location->address .": Added ". $newSpace['space_bedrooms']. "-bedrooms space \n";
	}	
}

?>
</pre>