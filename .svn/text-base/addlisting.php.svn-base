<?php

include_once('includes/config.php');

$smarty->assign("pageTitle", 'Add a New Listing');

$location_type = $FORM['location_type'];
if($location_type=='')
{
	$smarty->assign("body", $smarty->fetch("addlisting_choose_type.tpl"));
	$smarty->display("index.tpl");	
	exit;
}

if($FORM['save'] == 'Add It')
{	//Validate the submitted data
	$save_new = true;
	if(eregi('^[0-9]{1,2}$', $FORM['space_bedrooms'])===false)
	{
		$FORM['space_bedrooms'] = '';
		$messages[] = "How many bedrooms are there?";
		$save_new = false;
	}
	if(eregi('^[0-9]{1,2}(\.[0-9])?$', $FORM['space_bathrooms'])===false)
	{
		$FORM['space_bathrooms'] = '';
		$messages[] = "How many bathrooms are there?";
		$save_new = false;
	}
	if(eregi('^[0-9]{1,4}(\.[0-9]{1,2})?$', $FORM['space_rent'])===false)
	{
		$FORM['space_rent'] = '';
		$messages[] = "How much is the monthly rent?";
		$save_new = false;
	}
	
	if(!$User->complete_contact && $User->id == null)
	{	
		if(isset($FORM['save_w_new_account']) ){
		
			$smarty->assign('email', $FORM['email']);
			$ready_to_register = true;
			
			if(!ValidEmail($FORM['email'])){
				$messages[] = 'You need a valid email address.';
				$smarty->assign('email', ''); 
				$ready_to_register = false;
			}
			
			if( $AllUsers->find_by_email($FORM['email'])!== false ){
				$messages[] = "'<i>".$FORM['email']."</i>' is already registered. <br>Want to <a href='welcome.php'>log in</a> before adding this property?";
				$smarty->assign('email', '');
				$ready_to_register = false;
			}
			
			if($FORM['pass'] <> $FORM['confirm_pass'] OR $FORM['pass']=='')
			{
				$messages[] = 'Please enter two matching passwords.';
				$ready_to_register = false;
			}
			
			if($ready_to_register !== false)
			{
				$user = $AllUsers->new_from_form($FORM, 'owner');
				$_SESSION['user_id'] = $user->id;
			}
			 else
			{
				$save_new = false;
			}
		} else {
			$messages[] = 'Please login or create a new account';
			$save_new = false;
		}
	}
}

if(!$save_new)
{
	$smarty->assign('location_type', $location_type);
	
	$smarty->assign('messages', $messages);
	$smarty->assign('form', $FORM);
	$smarty->assign("body", $smarty->fetch("list_lease.tpl"));
	$smarty->display("index.tpl");	
}
 else
{
	$location = $AllLocations->new_from_form($FORM);
	$space = $location->new_space_from_form($FORM);
	header("Location: editlisting.php?id=".$location->id);
}

?>