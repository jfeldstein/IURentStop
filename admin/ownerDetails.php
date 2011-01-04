<?php

include_once('includes/config.php');

$owner = new User($FORM['id']);

$title = ($owner->company=='') ? 'Viewing '.$owner->full_name : 'Viewing '.$owner->company;

$smarty->assign("pageTitle", $title);
$smarty->assign('owner', $owner->to_array());
$smarty->assign("body", $smarty->fetch("admin_ownerDetails.tpl"));
$smarty->display("index.tpl");

?>
asdf