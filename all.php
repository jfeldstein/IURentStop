<?php
include_once('includes/config.php');


foreach($AllUsers->list_owners() as $owner){
	$owner = new User($owner['id']);
	$locations = $owner->locations;
			
	foreach($locations as $loc){
		$loc = new Location($loc['id']);
		
		foreach($loc->spaces as $space) {
			$results[] = array_merge($loc->to_array(),$space);
		}
	}
}

$smarty->assign('results', $results);

$smarty->assign("pageTitle", 'Every Apartment for Rent in Bloomington');
$smarty->assign("body", $smarty->fetch("all.tpl"));
$smarty->display("index.tpl");

?>
