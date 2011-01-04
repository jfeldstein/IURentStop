{literal}
<script language="javascript">
Event.observe(window, 'load', function() {
	activate_tag_cloud();
});
</script>
{/literal}
		
<div class="pageTitle">Search Our Listings</div>

<form action="search.php#results" id="search_form" method="POST">

<table class=displayTable cellspacing=0>
<thead>
<tr>
	<td>
		I Want:
		{html_options options=$search_types selected=$form.location_type name=location_type}
	</td>
	<td>With These Amenities: <i>Click to select</i></td>
</tr>
</thead>
<tr>
<td>
	<table>
	<tr style="text-align: center; vertical-align: bottom;">
		<td><br>
			<b>With:</b>
		</td>
		<td>
			&nbsp;
		</td>
		<td>
			<input type="text" name="space_bedrooms" value="{$form.space_bedrooms}" size='7' onkeypress="return numbersonly(this, event)">
			
		</td>
		<td>
			Bedrooms
		</td>
	</tr>
	<tr style="text-align: center; vertical-align: bottom;">
		<td><br>
			&nbsp;
		</td>
		<td>
			At least
		</td>
		<td>
			<input type="text" name="space_bathrooms" value="{$form.space_bathrooms}" size='7' onkeypress="return numbersonly(this, event, true)">
		</td>
		<td>
			Bathrooms
		</td>
	</tr>
	<tr style="text-align: center; vertical-align: bottom;">
		<td><br>
			<b>Rent:</b>
		</td>
		<td>
			At least
		</td>
		<td>
			<input type="text" class="money" name="space_rent_min" value="{$form.space_rent_min}" size='6' onkeypress="return numbersonly(this, event)">
		</td>
	</tr>
	<tr style="text-align: center; vertical-align: bottom;">
		<td width="75px"><br>
			&nbsp;
		</td>
		<td>
			No more than
		</td>
		<td>
			<input type="text" class="money" name="space_rent_max" value="{$form.space_rent_max}" size='6' onkeypress="return numbersonly(this, event)">
		</td>
	</tr>
	</table>
</td>
<td valign=top width="270">

		
		<div id="tagCloud">
			{foreach from=$amenities item=tag}
			{if $selected_tags[$tag.id]}
				<span class="tag selected" id="tag_{$tag.id}">{$tag.text}</span>
				<input type="hidden" name="selected_tags[{$tag.id}]" value="1" id="tag_input_{$tag.id}">
			{else}
				<span class="tag" id="tag_{$tag.id}">{$tag.text}</span>
			{/if}
			{/foreach}
		</div>
</td>
</tr>
<tr><td colspan=2 align=center><input type="submit" name="action" value="Search" DISABLED='true'>
<br>We're currently building our database of listings, so there's not much to search through yet.</td></tr></table>
</form>

{foreach from=$results item=result name=results}
	
	{if $smarty.foreach.results.first}
		
		<table class=displayTable cellspacing=0 id='results'>
		<thead><td colspan=2>Found {$num_results} matching listings</td></thead>
		<tr>
			<td widht=200 valign=top>	Suggested Locations:<hr></td>
			<td width=400><div id="map" style="width: 400px; height: 300px"></div></td>
		</tr>
		</table>
		<script language="javascript">
			{literal}
			if(GBrowserIsCompatible())
			{
				var map = new GMap2(document.getElementById("map"));
				map.setCenter(new GLatLng(39.168001, -86.522312), 13);
				map.addControl(new GSmallZoomControl());
			}
			{/literal}
		</script>
		
		<table class=displayTable cellspacing=0>
		<thead>
			<td></td>
			<td colspan=2 style='text-align: right;'>Bedrooms</td>
			<td colspan=2>Bathrooms</td>
			<td></td>
		</thead>
		<thead>
			<td></td>
			<td>Address</td>
			<td style="text-align: right; padding-right: 2mm;">&darr;</td>
			<td style="text-align: left; padding-left: 2mm;">&darr;</td>
			<td>Rent (Per Bedroom)</td>
			<td></td>
		</thead>
	{/if}
	
	<tr>
	<td>
		<div style='width:80px; float: left; margin-right: 1mm;'>
			{if $result.photo_id}
				<img src="photos/small/{$result.photo_id}.jpg">
			{else}
			&nbsp;
			{/if}
		</div>
	</td>
	<td>		
		<div style="display:none;"><div id='info_{$result.space_id}' style="text-align: right; margin-right: 2mm;">
		
					<a href="viewlisting.php?id={$result.space_id}">
						<img src="photos/small/{$result.photo_id}.jpg" style="float: left; margin-right: 1mm;">
					</a>
					{if $result.name!=''}
						<div class="result_name">{$result.name}</div>
					{/if}
					<div class='result_address'>{$result.address}</div>
					<div>${$result.rent/$result.bedrooms} per tenant</div>
						
					<br>
					<a href="viewlisting.php?id={$result.space_id}" style="font-weight: bold; ">
						Check it out!
					</a>
					<br>
		</div></div>
		
		<script language="javascript">
			result = unescape('{$result.json}').evalJSON();
			var point = new GLatLng(result.latitude, result.longitude);
			var marker{$result.space_id} = new GMarker(point);
			map.addOverlay(marker{$result.space_id});
			marker{$result.space_id}.bindInfoWindow($('info_{$result.space_id}'));
		</script>
	
	
		<a href="viewlisting.php?id={$result.space_id}" target="results" class="result">
			{if $result.name!=''}
				<div class="result_name">{$result.name}</div>
			{/if}
			<div class='result_address'>{$result.address}</div>
		</a>
		</td>
		<td>{$result.bedrooms}</td>
		<td>
			{if $result.bathrooms=='0.0'}
				***
			{else}
				{$result.bathrooms}
			{/if}
		</td>
		<td>${$result.rent} (${$result.rent/$result.bedrooms})</td>
		<td>
			{if $result.latitude!=0}
				<input type="button" value="Show on map" onclick="map.closeInfoWindow();map.setZoom(14); marker{$result.space_id}.openInfoWindow($('info_{$result.space_id}')); return false;">
				<br>
			{/if}
			<a href="viewlisting.php?id={$result.space_id}" style="font-weight: bold;">Look Closer</a>
		</td>
	</tr>
	<tr>
		<td colspan=6 style="border-bottom: 1px solid #000;">
			<div class='result_amenities'>
				{foreach from=$result.tags item=tag}
					<div class="result_tag">&#187; {$tag.text}</div>
				{/foreach}
			</div>
		</td>
	</tr>
{/foreach}