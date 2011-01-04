<?php

include_once('includes/config.php');



$smarty->assign("pageTitle", 'Search All Apartments for Rent in Bloomington');
$smarty->assign("body", $smarty->fetch("home.tpl"));
$smarty->display("index.tpl");

?>
