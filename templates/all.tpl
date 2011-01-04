
{foreach from=$results item=result name=results}
	{if $smarty.foreach.results.first}
		<table class=displayTable cellspacing=0>
		<thead>
			<td>Apartment Address</td>
			<td>Bedrooms</td>
			<td>Distance</td>
			<td><a href="search.php" style="float: right;">New Search</a></td>
		</thead>
	{/if}
	
	<tr style="min-height: 75px;" class="{foreach from=$result.tags item=tag} {$tag.text} {/foreach} resultRow">
	<td>		
		<div style="display:none;"><div id='info_{$result.space_id}' style="text-align: right; margin-right: 2mm;">
			{$result.address}
				
			<br>
			<a target="_blank" href="viewlisting.php?id={$result.space_id}" style="font-weight: bold; ">
				Check it out!
			</a>
			<br>
		</div></div>
		
	
	
		<a href="viewlisting.php?id={$result.space_id}" target="_blank" class="result">
			<div class='result_address'>{$result.address}</div>
		</a>
		</td>
		<td>{$result.br_string}</td>
		<td>{$result.distance} mi.</td>
		<td style="text-align: center;">
			
		</td>
	</tr>
	<tr class="{foreach from=$result.tags item=tag} {$tag.text} {/foreach} resultRow">
		<td colspan=6 style="border-bottom: 1px solid #000;">
			<div class='result_amenities'>
				{foreach from=$result.tags item=tag}
					<a style="cursor: pointer;" class="result_tag" title="Only Show Results With '{$tag.text}'" onclick="return filterResults('{$tag.text}');">&#187; {$tag.text}</a>
				{/foreach}
			</div>
		</td>
	</tr>
	
	{if $smarty.foreach.results.last}
		</table>
	{/if}
{/foreach}