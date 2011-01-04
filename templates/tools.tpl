	<table  class="spaceTable" cellspacing=0>
		<thead>
			<td colspan="2">Promotional Tools</td>
		</thead>
	<tr onclick="document.location='setup_tool.php?tool=google';">
		<td>
			{if $user.tools.google}
				<div style="color: green; font-weight: bold;">Enabled</div>
			{else}
				<div style="color: red; font-weight: bold;">Disabled</div>
			{/if}
		</td>
		<td><a href="setup_tool.php?tool=google">Publish</a> to Google rental search</td>
	</tr>
	<tr onclick="document.location='setup_tool.php?tool=facebook';">
		<td>
			{if $user.tools.facebook}
				<div style="color: green; font-weight: bold;">Enabled</div>
			{else}
				<div style="color: red; font-weight: bold;">Disabled</div>
			{/if}
		</td>
		<td><a href="setup_tool.php?tool=facebook">List</a> directly in the Facebook Marketplace</td>
	</tr>
	</table>