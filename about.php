<?php

include_once('includes/config.php');

$smarty->assign("pageTitle", 'About IURentStop');
$smarty->assign("body", $smarty->fetch("about.tpl"));
$smarty->display("index.tpl");	
?>