<?php /* Smarty version 2.6.18, created on 2009-03-16 12:53:28
         compiled from setup_facebook_tool.tpl */ ?>
<form action="setup_tool.php">

<table>
<thead><td colspan="2">List in Facebook Marketplace</td></thead>
<tr>
<td>
	<p>
		Enable this tool to automatically list your properties 
		in <a href="#" target="_blank">Facebook Marketplace</a> no link yet
	</p>
	
	<ul>
	This gives you:
	<li>Marketplace listings for each available unit</li>
	<li>Advertise listings where students will look</li>
	<li>Deployed with a single click</li>
	</ul>
	<?php if (0): ?>
	<?php if ($this->_tpl_vars['tool_enabled']): ?>
		<p>Currently: <b>Enabled</b>. <input type="submit" name="disable" value="Disable Marketplace Listings"></p>
	<?php else: ?>
		<p>Currently: <b>Disabled</b>. <input type="submit" name="enable" value="Enable Marketplace Listings" disabled="true"></p>
	<?php endif; ?>
	<?php endif; ?>
	<br>
	<hr>
	Due to recent changes to Facebook's servers, this service is currently unavailable.
	<input type="hidden" name="tool" value="facebook">
	
</td>
<td>
	<img src="images/facebook_marketplace.png" />
</td>
</tr>
</table>

</form>