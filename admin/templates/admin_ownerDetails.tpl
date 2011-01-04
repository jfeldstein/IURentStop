{include file="editaccount_form.tpl" user=$owner}


{foreach from=$owner.locations item=loc name=loc_loop}
	{if $smarty.foreach.loc_loop.first}
		<table  class="spaceTable" cellspacing=0>
		<thead>
			<td>Address</td>
			<td>Units</td>
		</thead>
	{/if}
	
	<tr onclick="openLocation('{$loc.id}');">
		<td>
			{$loc.address}
			{if $loc.name!=''}
				<br>
				{$loc.name}
			{/if}
		</td>
		<td>
			{$loc.num_spaces}
		</td>
	</tr>
	
	{if $smarty.foreach.loc_loop.last}
	</table>
	{/if}
{/foreach}