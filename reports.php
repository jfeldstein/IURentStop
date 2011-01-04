<?php
$require_login = true;
include_once('includes/config.php');

$smarty->assign("body", $smarty->fetch("reports.tpl"));
$smarty->display("index.tpl");	
?>