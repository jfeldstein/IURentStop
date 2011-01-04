<?php /* Smarty version 2.6.18, created on 2010-06-06 15:08:20
         compiled from setup_google_tool.tpl */ ?>
<form action="setup_tool.php">

<table>
<thead><td colspan="2">List in Google's Rental Search</td></thead>
<tr>
<td>
	<p>
		Enable this tool to automatically list your properties 
		in <a href="http://base.google.com/base/s2?a_n0=housing&a_y0=9&hl=en&gl=us" target="_blank">Google's Rental</a> search
	</p>
	
	<?php if ($this->_tpl_vars['tool_enabled']): ?>
		<p>Currently: <b>Enabled</b>. <input type="submit" name="disable" value="Disable Google Rental Search"></p>
	<?php else: ?>
		<p>Currently: <b>Disabled</b>. <input type="submit" name="enable" value="Enable Google Rental Search"></p>
	<?php endif; ?>
	<br>
	<a href="welcome.php">Back Your Account</a>
	<br>
	<hr>
	Changes may take a day to take affect.
	<input type="hidden" name="tool" value="google">
	
</td>
<td>
	<img src="images/google_base.png" />
</td>
</tr>
</table>

</form>