{foreach from=$saved_spaces item=space name=space_loop}
	{if $smarty.foreach.space_loop.first}
		<table  class="displayTable" cellspacing=0>
		<thead>
			<td align=center colspan=7>Watched Listings</td>
		</thead>
		<thead>
			<td></td>
			<td></td>
			<td colspan=2 style='text-align: right;'>Bedrooms</td>
			<td colspan=2>Bathrooms</td>
			<td></td>
		</thead>
		<thead>
			<td></td>
			<td></td>
			<td>Address</td>
			<td style="text-align: left; padding-right: 2mm;">&darr;</td>
			<td style="text-align: left; padding-left: 2mm;">&darr;</td>
			<td>Rent (Per Bedroom)</td>
			<td></td>
		</thead>
	{/if}
		<tr>
			<td>
				{if $space.random_photo.id}
					<img src="photos/small/{$space.random_photo.id}.jpg">
				{/if}
			</td>
			<td valign="middle">
				<a href="star_listing.php?id={$space.id}" onclick="new Ajax.Updater( this,'star_listing.php?id={$space.id}&ajax=1'); return false;">
				<img src="images/house_on.png" alt="Stop Watching This">
				</a>
			</td>
			<td>
				<a href="viewlisting.php?id={$space.id}" class="result">
					{if $space.name!=''}
						<div class="result_name">{$space.name}</div>
					{/if}
					<div class='result_address'>{$space.address}</div>
				</a>
			</td>
			<td>{$space.bedrooms}</td>
			<td>{$space.bathrooms}</td>
			<td>{$space.rent} (${$space.rent/$space.bedrooms|string_format:"%.2f"})</td>
			<td>
				<a href="viewlisting.php?id={$space.id}" class="result">
					Details
				</a>
			</td>
		</tr>
	{if $smarty.foreach.space_loop.last}
		</table>
	{/if}
{foreachelse}
	<table class="displayTable">
	<thead><td>Watched Listings</td></thead>
	<tr><td>
		<p>
			<b>You aren't watching any listings!</b>
			<a href="search.php">Get searching,</a> and find the house for you. 
		</p>
		<p>
			<img src="images/house_off.png" alt="House"> If something looks interesting, 
			click the house to save it to this list.		
		</p>
	</td></tr></table>
{/foreach}