{foreach from=$locations item=loc name=loc_loop}
	{if $smarty.foreach.loc_loop.first}
		<table  class="spaceTable" cellspacing=0>
		<thead>
			<td>Address</td>
			<td>Bedrooms</td>
			<td>Bathrooms</td>
			<td>Rent</td>
			<td>Available</td>
			<td></td>
		</thead>
	{/if}
	
	{if $loc.type=='apartment'}
		{foreach from=$loc.spaces item=space name=space_loop}
			<tr onclick="document.location='editlisting.php?id={$loc.id}';">

				{if $smarty.foreach.space_loop.first}
					<td style="height: 25px;">
						{$loc.address}
					</td>
				{else}
					<td style="text-align: center;">
						&quot;
					</td>
				{/if}
				<td>{$space.bedrooms}</td>
				<td>{$space.bathrooms}</td>
				<td>${$space.rent}</td>
				<td>{if $space.available>0}Yes{else}No{/if}</td>
				<td>
					{if $smarty.foreach.space_loop.last}<a style='margin-top: 2px;' href="editlisting.php?id={$loc.id}&sid=new"><img src="images/add.png" alt="Add"></a>{/if}</td>
			</tr>
		{/foreach}
	{else}
		<tr onclick="document.location='editlisting.php?id={$loc.id}';">
			<td>{$loc.address}</td>
			<td>{$loc.spaces[0].bedrooms}</td>
			<td>{$loc.spaces[0].bathrooms}</td>
			<td>${$loc.spaces[0].rent}</td>
			<td>{if $loc.spaces[0].available==1}Yes{else}No{/if}</td>
			<td></td>
		</tr>
	{/if}
	
	{if $smarty.foreach.loc_loop.last}
		</table>
	{/if}
{foreachelse}
	<table class="displayTable" cellspacing="0">
	<thead><td colspan=2>You don't have any properties listed</td></thead>
	<tr>
		<td colspan=2>
			<p>Listing on RentStop is free and it takes only a few minutes to get started.</p>
			<p>Go ahead, knock yourself out:</p>
			<hr>
		</td>
	</tr>
	<tr>
		<td width=50% style="padding-right: 5mm;">
			<input type="button" value="List an Apartment" style="float:right;" onclick="document.location='addlisting.php?location_type=apartment';">
			<b>Apartments</b> <br style='clear:both;'>
			Apartments have multiple rentable spaces that can each 
			have their own lease agreement. This includes a house whose rooms 
			you're leasing separately.
		</td>
		<td style="vertical-align: top;">
			<input type="button" value="List a House" style="float:right;" onclick="document.location='addlisting.php?location_type=house';">
			<b>Houses</b> <br style='clear:both;'> Houses only have one space being rented at the address
		</td>
	</tr>
</table>
{/foreach}