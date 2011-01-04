{include file="search_form_full.tpl"}

{foreach from=$results item=result name=results}
	{if $smarty.foreach.results.first}
		<table class=displayTable cellspacing=0 id='results'>
		<thead><td colspan=2>
			<div style="float: left;">Found {$num_results} matching listings</div>
			<a href="search.php" style="float: right;">New Search</a>
		</td></thead>
		<tr>
			{if $show_ads}
				{if $ads_on_left}
					<td widht=200 valign=top>	Suggested Locations:<hr></td>
					<td width=400><div id="map" style="width: 400px; height: 300px"></div></td>
				{else}
					<td width=400><div id="map" style="width: 400px; height: 300px"></div></td>
					<td widht=200 valign=top>	Suggested Locations:<hr></td>
				{/if}
			{else}
				<td colspan=2><div id="map" style="width: 640px; height: 300px"></div></td>
			{/if}
		</tr>
		</table>
		<script language="javascript">
			{literal}
			if(GBrowserIsCompatible())
			{
				var map = new GMap2(document.getElementById("map"));
				map.setCenter( btown, 13);
				map.addControl(new GSmallZoomControl());
			}
			{/literal}
		</script>
		
		<table class=displayTable cellspacing=0 id="filterListTable" style="display: none;">
		<thead>
			<td>Result Filters:</td>
		</thead>
		<tr>
			<td>
				Results will be filtered to only show listings with these amenities:
				<blockquote id="filterListText">
					
				</blockquote>
				<div style="text-align: center;"><input type="button" value="Clear Filters" onclick="clearResultFilters();"></div>
			</td>
		</tr>
		</table>
		
		<table class=displayTable cellspacing=0>
		<thead>
			<td></td>
			<td colspan=2 style='text-align: right;'>Bedrooms</td>
			<td colspan=2>Bathrooms</td>
			<td>
			<a href="search.php" style="float: right;">New Search</a></td>
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
	
	<tr style="min-height: 75px;" class="{foreach from=$result.tags item=tag} {$tag.text} {/foreach} resultRow">
	<td>
		<div style='width:80px; float: left; margin-right: 1mm;'>
			{if $result.photo_id}
				<a target="_blank" href="viewlisting.php?id={$result.space_id}">
					<img src="photos/small/{$result.photo_id}.jpg">
				</a>
			{else}
			&nbsp;
			{/if}
		</div>
	</td>
	<td>		
		<div style="display:none;"><div id='info_{$result.space_id}' style="text-align: right; margin-right: 2mm;">
		
			<a target="_blank" href="viewlisting.php?id={$result.space_id}">
				<img src="photos/small/{$result.photo_id}.jpg" style="float: left; margin-right: 1mm;">
			</a>
			{if $result.premium}
				<div style="font-weight: bold; font-size:90%;">
					<img src="images/star_on.png" style="margin-bottom: -3px;"> 
					Featured Listing
				</div>
				<div class="pseudoHR">&nbsp</div>
			{/if}
			{if $result.name!=''}
				<div class="result_name">{$result.name}</div>
			{/if}
			<div class='result_address'>{$result.address}</div>
			<div>${$result.rent} {if $result.bedrooms>1}(${$result.rent_per_bedroom}/Br){/if}</div>
				
			<br>
			<a target="_blank" href="viewlisting.php?id={$result.space_id}" style="font-weight: bold; ">
				Check it out!
			</a>
			<br>
		</div></div>
		
		
		{if $result.latitude!=0}
			<script language="javascript">
				result = unescape('{$result.json}').evalJSON();
				markerIcon = (result.premium=='1') ? new GIcon(G_DEFAULT_ICON, './images/icons/house_red.png') : new GIcon(G_DEFAULT_ICON, './images/icons/house_blue.png');
				{literal}markerOptions = {icon: markerIcon};{/literal}
				var point = new GLatLng(result.latitude, result.longitude);
				var marker{$result.space_id} = new GMarker(point, markerOptions);
				map.addOverlay(marker{$result.space_id});
				marker{$result.space_id}.bindInfoWindow($('info_{$result.space_id}').cloneNode(true));
			</script>
		{/if}
	
	
		<a target="_blank" href="viewlisting.php?id={$result.space_id}" target="_blank" class="result">
			{if $result.name!=''}
				<div class="result_name">{$result.name}</div>
			{/if}
			<div class='result_address'>{$result.address}</div>
		</a>
		</td>
		<td>{$result.bedrooms}</td>
		<td>{$result.distance}	</td>
		<td>
			${$result.rent} 
			{if $result.bedrooms>1}(${$result.rent_per_bedroom}){/if}
			</td>
		<td style="text-align: center;">
			{if $result.premium}
				<div style="padding-bottom: 2mm; font-weight: bold;"><img src="images/star_on.png"  style="margin-bottom: -3px;"> Featured Listing!</div>
			{/if}
			{if $result.latitude!=0}
				<input type="button" value="Show on map" onclick="Element.scrollTo('results'); map.closeInfoWindow();map.setZoom(14); marker{$result.space_id}.openInfoWindow($('info_{$result.space_id}').cloneNode(true)); return false;">
			{/if}
			
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
{/foreach}