<?php
ob_start();
session_start();

$GoogleKeys['localhost']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRqtZcdZOINDSAPkoJV2xQR5QoXnA';
$GoogleKeys['local.iurentstop.com']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohTBUyel1ZKoYTbJRdrNUh9v8EpJ9xR3EihXk0WCGlrX_dEScmRdGrPWqw';
$GoogleKeys['local.admin.iurentstop.com']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohTAB49dww3neLm-82aii1tQm_mZphTrLGKXQo3JrKOmcfk_wMkeYZDDsg';

if(in_array($_SERVER['SERVER_NAME'], array('localhost', 'local.iurentstop.com', 'local.admin.iurentstop.com')))
{
	$CONFIG['sql_server'] 	= 'localhost';
	$CONFIG['sql_user']		= 'root';
	$CONFIG['sql_pass']		= '';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= $GoogleKeys[$_SERVER['SERVER_NAME']];
}
 elseif($_SERVER['SERVER_NAME']=='dev.iurentstop.com')
{
	$CONFIG['sql_server'] 	= 'mysql.iurentstop.com';
	$CONFIG['sql_user']		= 'rentdev';
	$CONFIG['sql_pass']		= 'quantum';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohTu6bTww8vswIKRbdPN-KUEBeqOJRThptc_Ee5arSSv5Tm4T8IKZOpivg';
}
 elseif($_SERVER['SERVER_NAME']=='www.iurentstop.com')
{
	$CONFIG['sql_server'] 	= 'mysql.iurentstop.com';
	$CONFIG['sql_user']		= 'rentdev';
	$CONFIG['sql_pass']		= 'quantum';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohTXYM5G9pR2Fj9urmlhE4sA1Q45qhTTycT2AJqo3XgWVNMBthaSV02xeA';
}
 elseif($_SERVER['SERVER_NAME']=='admin.iurentstop.com')
{
	$CONFIG['sql_server'] 	= 'mysql.iurentstop.com';
	$CONFIG['sql_user']		= 'rentdev';
	$CONFIG['sql_pass']		= 'quantum';
	$CONFIG['sql_dbname']	= 'rentals';
	$CONFIG['google_key']	= 'ABQIAAAAXZYjCdXPNEKSbJuUce-5ohSEClttA3HCzr5kytYUYXSRevfKDhSHESL_FYRzMOAf3lY8M0fFb0QURA';
}

$CONFIG['email_regex'] 		= "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$";
$CONFIG['search_types'] 	= array('house'=>'A House', 'apartment'=>'An Apartment', 'anything'=>'Anything');
$CONFIG['photo_size_small']	= 80;
$CONFIG['photo_size_med']	= 250;
$CONFIG['photo_size_large']	= 500;
$CONFIG['floorplan_size_small']	= 80;
$CONFIG['floorplan_size_med']	= 250;
$CONFIG['floorplan_size_large']	= 500;

include('./includes/functions.php');
include('./includes/class.phpmailer.php');
include('./includes/class.thing.php');
include('./includes/class.user.php');
include('./includes/class.allusers.php');
include('./includes/class.sql.php');
include('./includes/class.space.php');
include('./includes/class.allspaces.php');
include('./includes/class.location.php');
include('./includes/class.alllocations.php');
include('./includes/class.alltags.php');
include('./includes/class.tag.php');
require('./smarty/Smarty.class.php');

$FORM 	= parse_form();
$smarty = new Smarty();
$mail= new PHPMailer();

$db = new SQL($CONFIG['sql_server'], $CONFIG['sql_user'], $CONFIG['sql_pass'], $CONFIG['sql_dbname']) or die(mysql_error(). " - No connection to database");
//$db->ShowErrors();
 
$AllUsers 		= new AllUsers;
$AllLocations 	= new AllLocations;
$AllSpaces 		= new AllSpaces;
$AllTags		= new AllTags;

$messages 		= $_SESSION['messages']; unset($_SESSION['messages']);
$stored_form	= (isset($_SESSION['saved_form'])) ? $stored_form= unserialize($_SESSION['saved_form']) : array(); 
				  unset($_SESSION['saved_form']);
$FORM 			= array_merge($stored_form, $FORM);

$smarty->assign('show_nav', false);  // Show nav links by default
$smarty->assign('google_key', $CONFIG['google_key']);  // Assign this domains google API key
$smarty->assign('yesno', array('1'=>'Yes','0'=>'No'));
$smarty->register_function('json', 'make_json');

if(($User = $AllUsers->find_by_email_and_passhash($FORM['email'], md5($FORM['pass'])))!==false)
	$_SESSION['user_id'] = $User->id;

if($require_login && !isset($_SESSION['user_id']))
{	$smarty->assign('forward_to', $_SERVER['PHP_SELF']);
	$smarty->assign('body', $smarty->fetch('login.tpl'));
	$smarty->display('index.tpl');
	exit;
}
 elseif(isset($_SESSION['user_id']))
{	$User = new User($_SESSION['user_id']);
	$smarty->assign('logged_in_as', $User->email);
}
?>