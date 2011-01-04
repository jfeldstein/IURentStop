<?php

include_once('includes/config.php');

session_destroy();
$smarty->assign('logged_in_as', '');

$smarty->assign("pageTitle", 'Logged Out');
$smarty->assign("body", $smarty->fetch("loggedout.tpl"));
$smarty->display("index.tpl");	

?>