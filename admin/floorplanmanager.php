<?php
include_once('includes/config.php');

$smarty->assign('target_type', 'space');
$smarty->assign('target_id', $FORM['target_id']);

switch($FORM['action'])
{
	case 'showform':
		$space = new Space($FORM['target_id']);
		$smarty->assign('obj', $space->to_array());
		$smarty->assign('floorplans_total', count($space->all_floorplans));
		$smarty->assign('floorplans_visible_total', count($space->visible_floorplans));
		$smarty->assign('location_type', $FORM['type']);
		$smarty->display("_floorplan_form.tpl");
	break;
	
	case 'default':
		$smarty->display("_floorplan_default.tpl");
	break;
	
	case 'addfloorplan':
		$src = $_FILES['item_data']['tmp_name'];
		$name= $_FILES['item_data']['name'];
		$space = new Space($FORM['target_id']);
		
		$uploadErrors = array(
		    UPLOAD_ERR_INI_SIZE => 'The file is too big.',
		    UPLOAD_ERR_FORM_SIZE => 'The file is too big.',
		    UPLOAD_ERR_PARTIAL => 'The uploaded floorplan was only partially uploaded.',
		    UPLOAD_ERR_NO_FILE => 'No floorplan was uploaded.',
		    UPLOAD_ERR_NO_TMP_DIR => 'Server Error: Missing a temporary folder.',
		    UPLOAD_ERR_CANT_WRITE => 'Server Error: Failed to write file to disk.',
		    UPLOAD_ERR_EXTENSION => 'Server Error: File upload stopped by extension.',
		);
		$errorCode = $_FILES['item_data']['error'];

		if(isset($uploadErrors[$errorCode]))
			die($uploadErrors[$errorCode]);
			
		$format = strtolower(substr($name, -4));
		if($format<>'.gif')
			die("Can't use '$format': Only floorplans in GIF format can be used.");
		
		if(($errormsg = $space->add_floorplan($_FILES['item_data']))!==true)
			die($errormsg);
		
		die('success');
	break;
	
	case 'activatefloorplan':
		$sql = "SELECT * FROM floorplans as f, spaces as s, locations as l "
					  ."WHERE f.id='".$FORM['item_id']."' "
					    ."AND (f.space_id=s.id AND s.location_id=l.id) "
						."AND l.user_id=".$User->id;
		$floorplan = $db->FetchRow($db->Run($sql));
		if($db->NumRows()==0)
			exit('not yours');
			
		$obj = new Space($floorplan['space_id']);
		$return['div_id'] = 'floorplan_'.$FORM['item_id'];
		$sql = "UPDATE `floorplans` "
			."SET `visible`='1' "
			."WHERE `id`='".$FORM['item_id']."'";
		$db->Run($sql);
		die('success');
	break;
	
	case 'deactivatefloorplan':
		$sql = "SELECT * FROM floorplans as f, spaces as s, locations as l "
					  ."WHERE f.id='".$FORM['item_id']."' "
					    ."AND (f.space_id=s.id AND s.location_id=l.id) "
						."AND l.user_id=".$User->id;
		$floorplan = $db->FetchRow($db->Run($sql));
		if($db->NumRows()==0)
			exit('not yours');
			
		$return['div_id'] = 'floorplan_'.$FORM['item_id'];
		$sql = "UPDATE `floorplans` "
			."SET `visible`='0' "
			."WHERE `id`='".$FORM['item_id']."'";
		$db->Run($sql);
		die('success');
	break;
	
	case 'deleteitem':
		$sql = "SELECT * FROM floorplans as f, spaces as s, locations as l "
					  ."WHERE f.id='".$FORM['item_id']."' "
					    ."AND (f.space_id=s.id AND s.location_id=l.id) "
						."AND l.user_id=".$User->id;
		$floorplan = $db->FetchRow($db->Run($sql));
		if($db->NumRows()==0)
			exit('not yours');
			
		$sql = "DELETE FROM `floorplans` WHERE floorplans.id='".$FORM['item_id']."'";
		$db->Run($sql);
		
		unlink("floorplans/small/".$FORM['item_id'].".gif");
		unlink("floorplans/med/".$FORM['item_id'].".gif");
		unlink("floorplans/large/".$FORM['item_id'].".gif");
		
		die('success');
	break;
	
	case 'recaptionitem':
		$sql = "SELECT * FROM floorplans as f, spaces as s, locations as l "
					  ."WHERE f.id='".$FORM['item_id']."' "
					    ."AND (f.space_id=s.id AND s.location_id=l.id) "
						."AND l.user_id=".$User->id;
		$floorplan = $db->FetchRow($db->Run($sql));
		if($db->NumRows()==0)
			exit('not yours');
			
		$sql = " UPDATE `floorplans` as f "
				." SET `caption`='".$FORM['caption']."' "
			  ." WHERE f.id='".$FORM['item_id']."'";
		$db->Run($sql);
		
		die('success');
	break;
}

?>