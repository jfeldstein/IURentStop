<?php
$require_login = true;
include_once('includes/config.php');

$smarty->assign('locations', $User->locations);
$smarty->assign('forward', 'myproperties.php');

$smarty->assign("body", $smarty->fetch("myproperties.tpl"));
$smarty->display("index.tpl");	

?>