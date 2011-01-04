<?php
include_once('includes/config.php');

$smarty->assign('target_type', $FORM['target_type']);
$smarty->assign('target_id', $FORM['target_id']);

switch($FORM['action'])
{
	case 'showform':
		$sql = "SELECT SUM(p.visible) as 'photos_visible_total', COUNT(p.id) as 'photos_total' "
			  ."FROM photos as p "
			  ."WHERE "
				."(p.for_type='location' AND EXISTS (SELECT * FROM locations as l WHERE l.id=p.for_id AND l.user_id=".$User->id.")) "
				." OR "
				."(p.for_type='space' AND EXISTS (SELECT * FROM spaces as s, locations as l WHERE s.id=p.for_id AND s.location_id=l.id AND l.user_id=".$User->id.")) ";
		$totals = $db->FetchRow($db->Run($sql));
		$obj = ($FORM['target_type']=='location') ? new Location($FORM['target_id']) : new Space($FORM['target_id']);
		$location = ($FORM['target_type']=='location') ? $obj : new Location($obj->belongs_to_location_id);
		
		$smarty->assign('obj', $obj->to_array());
		$smarty->assign('location', $location->to_array());
		$smarty->assign('object_photos_total', count($obj->all_photos));
		$smarty->assign('object_photos_visible', count($obj->visible_photos));
		$smarty->assign('credits_used', $User->num_photo_credits_used);
		$smarty->assign('credits', $User->num_photo_credits);
		$smarty->assign('photos_total', $totals['photos_total']);
		$smarty->assign('photos_visible_total', $totals['photos_visible_total']);
		$smarty->assign('location_type', $FORM['type']);
		$smarty->display("_photos_form.tpl");
	break;
	
	case 'default':
		$smarty->display("_photos_default.tpl");
	break;
	
	case 'addphoto':
		$src = $_FILES['item_data']['tmp_name'];
		$name= $_FILES['item_data']['name'];
		$obj = ($FORM['target_type']=='location') ? new Location($FORM['target_id']) : new Space($FORM['target_id']);
		
		$uploadErrors = array(
		    UPLOAD_ERR_INI_SIZE => 'The file is too big.',
		    UPLOAD_ERR_FORM_SIZE => 'The file is too big.',
		    UPLOAD_ERR_PARTIAL => 'The uploaded photo was only partially uploaded.',
		    UPLOAD_ERR_NO_FILE => 'No photo was uploaded.',
		    UPLOAD_ERR_NO_TMP_DIR => 'Server Error: Missing a temporary folder.',
		    UPLOAD_ERR_CANT_WRITE => 'Server Error: Failed to write file to disk.',
		    UPLOAD_ERR_EXTENSION => 'Server Error: File upload stopped by extension.',
		);
		$errorCode = $_FILES['item_data']['error'];

		if(isset($uploadErrors[$errorCode]))
			die($uploadErrors[$errorCode]);
		
		$format = strtolower(substr($name, -4));
		if($format<>'.jpg')
			die("Only photos in JPG format can be used.");
		
		if(($errormsg = $obj->add_photo($_FILES['item_data']))!==true)
			die($errormsg);
		
		die('success');
	break;
	
	case 'activatephoto':
		$sql = "SELECT * FROM photos as p, spaces as s, locations as l "
					  ."WHERE p.id='".$FORM['item_id']."' "
					    ."AND ("
							."(p.for_type='location' AND p.for_id=l.id) "
							  ." OR "
							."(p.for_type='space' AND p.for_id=s.id AND s.location_id=l.id)) "
						."AND l.user_id=".$User->id;
		$photo = $db->FetchRow($db->Run($sql));
		if($db->NumRows()==0)
			exit('not yours');
			
		$obj = ($photo['for_type']=='Location') ? new Location($photo['for_id']) : new Space($photo['for_id']);
		$return['div_id'] = 'photo_'.$FORM['item_id'];
		if($User->num_photo_credits > $User->num_photo_credits_used OR count($obj->visible_photos)==0)
		{
			$sql = "UPDATE `photos` "
				."SET `active`='1', `visible`='1' "
				."WHERE `id`='".$FORM['item_id']."'";
			$db->Run($sql);
			die('success');
		}
		else
		{
			die('not_enough');
		}
	break;
	
	case 'deactivatephoto':
		$sql = "SELECT * FROM photos as p, spaces as s, locations as l "
					  ."WHERE p.id='".$FORM['item_id']."' "
					    ."AND ("
							."(p.for_type='location' AND p.for_id=l.id) "
							  ." OR "
							."(p.for_type='space' AND p.for_id=s.id AND s.location_id=l.id)) "
						."AND l.user_id=".$User->id;
		$db->Run($sql);
		if($db->NumRows()==0)
			exit('not yours');
			
		$return['div_id'] = 'photo_'.$FORM['item_id'];
		$sql = "UPDATE `photos` "
			."SET `active`='0', `visible`='0' "
			."WHERE `id`='".$FORM['item_id']."'";
		$db->Run($sql);
		die('success');
	break;
	
	case 'deleteitem':
		$sql = "SELECT * FROM photos as p, spaces as s, locations as l "
					  ."WHERE p.id='".$FORM['item_id']."' "
					    ."AND ("
							."(p.for_type='location' AND p.for_id=l.id) "
							  ." OR "
							."(p.for_type='space' AND p.for_id=s.id AND s.location_id=l.id)) "
						."AND l.user_id=".$User->id;
		$db->Run($sql);
		if($db->NumRows()==0)
			exit('not yours');
			
		$sql = "DELETE FROM `photos` WHERE photos.id='".$FORM['item_id']."'";
		$db->Run($sql);
		
		unlink("photos/small/".$FORM['item_id'].".jpg");
		unlink("photos/med/".$FORM['item_id'].".jpg");
		unlink("photos/large/".$FORM['item_id'].".jpg");
		
		die('success');
	break;
	
	case 'recaptionitem':
		$sql = "SELECT * FROM photos as p, spaces as s, locations as l "
					  ."WHERE p.id='".$FORM['item_id']."' "
					    ."AND ("
							."(p.for_type='location' AND p.for_id=l.id) "
							  ." OR "
							."(p.for_type='space' AND p.for_id=s.id AND s.location_id=l.id)) "
						."AND l.user_id=".$User->id;
		$db->Run($sql);
		if($db->NumRows()==0)
			exit('not yours');
			
		$sql = " UPDATE `photos` as p "
				." SET `caption`='".$FORM['caption']."' "
			  ." WHERE p.id='".$FORM['item_id']."'";
		$db->Run($sql);
		
		die('success');
	break;
	
}

?>