<?php
include_once('includes/config.php');

$words = explode(' ', $FORM['new_tag']);

$sql = "SELECT *, count(tl.tag_id) as count FROM tags as t, tag_links as tl "
	  ."WHERE t.id=tl.tag_id AND ";
foreach($words as $word)
{	$sql .= " t.text LIKE '$word%' OR "; }
$sql .= "0 GROUP BY t.id ORDER BY count DESC";

$db->Run($sql);

if($db->NumRows()==0)
	exit;

$rows = $db->FetchRowSet();
echo "<ul>";
foreach($rows as $row)
{
	echo "<li>".$row['text']."</li>";
}
echo "</ul>";
?>