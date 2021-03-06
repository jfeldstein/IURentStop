<?php
//ob_start();
session_start();

$GoogleKeys['localhost']	= '';
$GoogleKeys['local.iurentstop.com']	= '';
$GoogleKeys['local.admin.iurentstop.com']	= '';

if(in_array($_SERVER['SERVER_NAME'], array('localhost', 'local.iurentstop.com', 'local.admin.iurentstop.com')))
{
	$CONFIG['sql_server'] 	= 'localhost';
	$CONFIG['sql_user']		= 'root';
	$CONFIG['sql_pass']		= '';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= $GoogleKeys[$_SERVER['SERVER_NAME']];
	$CONFIG['localhost']	= true;
}
 elseif($_SERVER['SERVER_NAME']=='dev.iurentstop.com')
{
	$CONFIG['sql_server'] 	= 'mysql.iurentstop.com';
	$CONFIG['sql_user']		= 'rentdev';
	$CONFIG['sql_pass']		= 'jG48_kkD';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= '';
}
 elseif($_SERVER['SERVER_NAME']=='www.iurentstop.com')
{
	$CONFIG['sql_server'] 	= 'mysql.iurentstop.com';
	$CONFIG['sql_user']		= 'rentdev';
	$CONFIG['sql_pass']		= 'jG48_kkD';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= '';
}

$CONFIG['email_regex'] 		= "^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
$CONFIG['search_types'] 	= array('house'=>'A House', 'apartment'=>'An Apartment', 'anything'=>'Anything');
$CONFIG['photo_size_small']	= 80;
$CONFIG['photo_size_med']	= 250;
$CONFIG['photo_size_large']	= 500;
$CONFIG['floorplan_size_small']	= 80;
$CONFIG['floorplan_size_med']	= 250;
$CONFIG['floorplan_size_large']	= 500;
$CONFIG['allowed_account_types']= array('student', 'owner');
$CONFIG['btown_center_lat']	= '39.171993';
$CONFIG['btown_center_lon']	= '-86.517334';

include('./includes/functions.php');
require('./smarty/Smarty.class.php');

loadClasses();

$FORM 	= parse_form();
$smarty = new Smarty();
$mail= new PHPMailer();
	$mail->Host     = "localhost";
	$mail->Mailer   = "smtp";
	$mail->IsSMTP();  

$db = new SQL($CONFIG['sql_server'], $CONFIG['sql_user'], $CONFIG['sql_pass'], $CONFIG['sql_dbname']);
if(!$db->connected) die(mysql_error(). " - No connection to database");
$db->ShowErrors();


 
$AllUsers 		= new AllUsers;
$AllLocations 	= new AllLocations;
$AllSpaces 		= new AllSpaces;
$AllTags		= new AllTags;
$AllComputers	= new AllComputers;

$messages 		= $_SESSION['messages']; unset($_SESSION['messages']);
$stored_form	= (isset($_SESSION['saved_form'])) ? $stored_form= unserialize($_SESSION['saved_form']) : array(); 
				  unset($_SESSION['saved_form']);
$FORM 			= array_merge($stored_form, $FORM);

$smarty->assign('localhost', $CONFIG['localhost']);
$smarty->assign('skip_notice', $_COOKIE['skip_notice']);
$smarty->assign('google_key', $CONFIG['google_key']);  // Assign this domains google API key
$smarty->assign('form', $FORM);
$smarty->assign('btown_center_lat', $CONFIG['btown_center_lat']);
$smarty->assign('btown_center_lon', $CONFIG['btown_center_lon']);
$smarty->register_function('json', 'make_json');

// Template variables
$smarty->assign('yesno', array('1'=>'Yes','0'=>'No'));
$smarty->assign('bedrooms', array('Efficiency (Studio)','1 Bedroom','2 Bedrooms','3 Bedrooms','4 Bedrooms','5 Bedrooms','6 Bedrooms','7+ Bedrooms'));
$smarty->assign("house_or_apartment", array("house" => "House", "apartment" => "Apartment"));
$smarty->assign('bedroom_options', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7+'));
$smarty->assign('bathroom_options', array('1'=>'1+','2'=>'2+','3'=>'3+'));
$smarty->assign('more_units_options', array('apartment'=>' Yes -','house'=>' No'));
$smarty->assign('yes_no_options', array('1'=>' Yes -','0'=>' No'));
$smarty->assign('location_type_options', array('anything'=>'Houses or Apartments','house'=>'Just houses', 'apartment' => 'Just Apartments'));


if($FORM['email']!='' AND $FORM['pass']!='')
{	
	$User = $AllUsers->find_by_email_and_passhash($FORM['email'], md5($FORM['pass']));
	if($User)
		$_SESSION['user_id'] = $User->id;
}

if($require_login && !isset($_SESSION['user_id']))
{	$smarty->assign('forward_to', $_SERVER['PHP_SELF']);
	$smarty->assign('body', $smarty->fetch('login.tpl'));
	$smarty->display('index.tpl');
	exit;
}
 elseif(isset($_SESSION['user_id']))
{	
	if(!$User || $User->id == -1)
		$User = new User($_SESSION['user_id']);
	$smarty->assign('logged_in_as', $User->email);
	$smarty->assign('user', $User->to_array());
}

$Computer = (!isset($_COOKIE['cid'])) ? $AllComputers->new_computer() : $AllComputers->find_by_id($_COOKIE['cid']);

// Tracking referrals
$referralArray = parse_url($_SERVER['HTTP_REFERER']);
if(eregi('iurentstop\.com$', $referralArray['host']) === false AND $referralArray['host'] <> '')
{
	$Computer->log('camefrom', $referralArray['host']);
} elseif($referralArray['path'] <> '') {
	$smarty->assign('referrer', $referralArray['path']);
}

?>