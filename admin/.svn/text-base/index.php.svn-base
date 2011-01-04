<?php

include_once('includes/config.php');

$owners = $AllUsers->list_owners();

$smarty->assign("pageTitle", 'Admin IURS');
$smarty->assign('owners', $owners);
$smarty->assign("body", $smarty->fetch("admin_owners.tpl"));
$smarty->display("index.tpl");

?>