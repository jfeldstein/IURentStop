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
	{if 0}
	{if $tool_enabled}
		<p>Currently: <b>Enabled</b>. <input type="submit" name="disable" value="Disable Marketplace Listings"></p>
	{else}
		<p>Currently: <b>Disabled</b>. <input type="submit" name="enable" value="Enable Marketplace Listings" disabled="true"></p>
	{/if}
	{/if}
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