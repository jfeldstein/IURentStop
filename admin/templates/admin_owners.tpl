{foreach from=$owners item=owner name=owner_loop}
	{if $smarty.foreach.owner_loop.first}
		<table  class="spaceTable" cellspacing=0>
		<thead>
			<td>Owner Name</td>
			<td>Listings</td>
			<td>Phone</td>
			<td>Email</td>
		</thead>
	{/if}
	
	<tr onclick="openOwner('{$owner.id}');">
		<td>
			{$owner.full_name}
			{if $owner.company!=''}
				({$owner.company})
			{/if}
		</td>
		<td>
			Has {$owner.num_locations}
		</td>
		<td>
			{$owner.phone}
		</td>
		<td>
			<a href="mailto:{$owner.email}">{$owner.email}</a>
		</td>
	</tr>
	
	{if $smarty.foreach.owner_loop.last}
	</table>
	{/if}
{/foreach}