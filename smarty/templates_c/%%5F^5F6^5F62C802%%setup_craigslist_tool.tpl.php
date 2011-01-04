<?php /* Smarty version 2.6.18, created on 2009-03-16 15:16:12
         compiled from setup_craigslist_tool.tpl */ ?>
<form action="setup_tool.php">

<table>
<thead><td colspan="2">Post automatic Craigslist classifieds</td></thead>
<tr>
<td>
	<p>
		Enable this tool to get extra exposure by automatically posting Craigslist classifieds for all your available units
	</p>
	
	<?php if ($this->_tpl_vars['tool_enabled']): ?>
		<p>Currently: <b>Enabled</b>. <input type="submit" name="disable" value="Disable Craigslist Postings"></p>
	<?php else: ?>
		<p>Currently: <b>Disabled</b>. <input type="submit" name="enable" value="Enable Craigslist Postings"></p>
	<?php endif; ?>
	
	<br>
	<hr>
	Changes may take up to a day to take effect
	<input type="hidden" name="tool" value="craigslist">
	
</td>
<td>
	<img src="images/craigslist_postings.png" />
</td>
</tr>
</table>

</form>