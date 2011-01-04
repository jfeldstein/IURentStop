{literal}
<script language="javascript">
Event.observe(window, 'load', function() {
	if (document.images)
	{
		star_on 	= new Image(1,1); 
		star_on.src = "./images/star_on.png"; 
		star_off 	= new Image(1,1); 
		star_off.src= "./images/star_off.png"; 
	}
});
</script>
{/literal}

<table class=displayTable cellspacing=0>
<tr>
	<td rowspan=2  style="width: 300px;" valign=top> 
		<div id="mapspace">
		{if $location.latitude!=0}
			{if $form.realmap}
				<div id="map_canvas" style="width: 300px; height: 250px"></div>
				<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
				<script language="javascript">
					var latitude 	= {$location.latitude};
					var longitude	= {$location.longitude};
					{literal}
					if(GBrowserIsCompatible())
					{
						var map = new GMap2(document.getElementById("map_canvas"));
						map.setCenter(new GLatLng(latitude, longitude), 13);
						GEvent.addListener(map,  'moveend',  function(){
							map.panTo(new GLatLng(latitude, longitude));
						});
						var point = new GLatLng(latitude, longitude);
						var marker = new GMarker(point);
						map.addOverlay(marker);
						map.addControl(new GSmallZoomControl());
						
						campusPoints= new Array();
						campusPoints[0] = new GLatLng(39.171428,-86.523299);
						campusPoints[1] = new GLatLng(39.173382,-86.522355);
						campusPoints[2] = new GLatLng(39.173395,-86.52103);
						campusPoints[3] = new GLatLng(39.178747,-86.520853);
						campusPoints[4] = new GLatLng(39.178481,-86.510038);
						campusPoints[5] = new GLatLng(39.16449,-86.509566);
						campusPoints[6] = new GLatLng(39.164524,-86.526818);
						campusPoints[7] = new GLatLng(39.171428,-86.526818);
						
						campus = new GPolygon(campusPoints, '#CC0000', 2, .5, '#FF0000');
						map.addOverlay(campus)
						
					}
					Event.observe(window, 'unload', function() {
						GUnload();
					});
					{/literal}
				</script>
			{else}
				<a href="viewlisting.php?id={$space.id}&realmap=1">
					<img src="http://maps.google.com/staticmap?zoom=13&size=300x250&key={$google_key}&markers={$location.latitude},{$location.longitude}" alt="Map">
				</a>
			{/if}
		{else}
			<!-- <img src='images/unknown_map.gif' alt="Couldn't locate this address on our map"> -->
		{/if}
		</div>

		{foreach from=$other_spaces_in_location item=other_space name=other_spaces}
			{if $smarty.foreach.other_spaces.first}
			<div id="otherSpaces" style="display: none;padding-top: 2mm; text-align: center;">
			<div style="font-weight: bold; margin: 3mm 0;">Other Apartments in this Building</div>
			
			<table>
			{/if}
				
				<tr>
					<td>
						{$other_space.bedrooms}-Bedroom
					</td>
					<td>
						{$other_space.bathrooms}-Bathrooms
					</td>
					<td>
						${$other_space.rent}
					</td>
					<td>
						(${$other_space.rent/$other_space.bedrooms|string_format:"%.2f"})
					</td>
					<td>
						<a href="viewlisting.php?id={$other_space.id}">
							<img border=0 src='images/go.png' alt="Go">
						</a>
					</td>
				</tr>
				
			{if $smarty.foreach.other_spaces.last}
			</table>
			<div  style="text-align: center; margin-top: 3mm;">
			<input type="button" value="Show Map" onclick="$('otherSpaces').hide(); $('mapspace').show();">
			</div>
			</div>
			{/if}
		{/foreach}
		
	</td>
	<td valign=top style='width: 285px;'>
		<div class="pageTitle">
			{if $location.name!=''}{$location.name}<br>{/if}
			{$location.address}
		</div>
		<div class="pseudoHR">&nbsp;</div>
		
		{if $location.premium}
			<div style="font-weight: bold; font-size:90%;">
				<img src="images/star_on.png" width=16 height=16 style="margin-bottom: -3px;"> Featured Listing</div>
			<div class="pseudoHR">&nbsp</div>
		{/if}
		
		{if $user.email!=''}
			{if $location_is_starred}
				<a style="float:right;" href="star_listing.php?id={$space.id}" onclick="new Ajax.Updater( this,'star_listing.php?id={$space.id}&ajax=1'); return false;">
				<img src="images/house_on.png" width=16 height=16 alt="Un-Star This">
				</a>
			{else}
				<a style="float:right;" href="star_listing.php?id={$space.id}" onclick="new Ajax.Updater( this,'star_listing.php?id={$space.id}&ajax=1'); return false;">
				<img src="images/house_off.png" width=16 height=16 alt="Star This">
				</a>
			{/if}
		{else}
			<a style="float:right;" href="register.php?type=student&forward=star_listing.php%3Fid%3D{$space.id}" class="lbOn">
			<img src="images/house_off.png" width=16 height=16 alt="Star This">
			</a>
		{/if}
		
		<table>
			<tr><td>Bedrooms:</td><td>{$space.bedrooms}</td></tr>
			<tr><td>Bathrooms:</td><td>{$space.bathrooms}</td></tr>
			<tr><td>Rent:</td><td>${$space.rent}</td></tr>
			<tr><td>Rent per Bedroom:</td><td>${$space.rent/$space.bedrooms|string_format:"%.2f"}</td></tr>
		</table>
		
				<div class="pseudoHR">&nbsp;</div>
		
				{if $space.available>0}
					<b style="color: #0C0; margin-left: 15mm;">Available now!</b>
				{else}
					<div style=" margin-left: 15mm;">(Not available at the moment)</div>
				{/if}				
				{if $withphone!=true}
				<br>
					<a href="viewlisting.php?id={$space.id}&withphone=1#phone" onclick="return (showPhone('{$space.id}'))? false : false;">
					<img border=0 src='images/red_phone.png' width=16 height=16> Call {$owner.top_name}
					</a>
				{/if}
				{if $num_osil>0}
				<br>
				<a href="#" onclick="$('mapspace').hide(); $('otherSpaces').show(); return false;">
				<img border=0 src='images/house_go.png' width=16 height=16> Other Apartments in this Building ({$num_osil})
				</a>
				{/if}
				{if $location.belongs_to_user_id==$user.id}
				<br>
				<a href="editlisting.php?id={$location.id}">
				<img border=0 src='images/wrench.png' width=16 height=16> Edit This Listing
				</a>
				{/if}
	</td>
</tr>
<tr>
	<td>
		{if $form.realmap}<div style="float: left;border: 2px solid #CC3333;display: inline; background-color: #FF9999;">Campus</div>{/if}
	</td>
</tr>
</table>

<table class=displayTable>
<thead><td width=50%>Photos</td><td>Floorplans</td></thead>
<tr>
	<td>
	{foreach from=$space.listing_photos item=photo}		
		<a href="photos/large/{$photo.id}.jpg" class='lightbox' title="{$photo.caption}" style="width: 85px; height: 85px; vertical-align: middle; text-align: center;">
		<img id='photo_{$photo.id}' src='photos/small/{$photo.id}.jpg'>
		</a>
	{foreachelse}
		<p>We have no photos of this property</p>
	{/foreach}
	</td>
	<td>
	{foreach from=$space.visible_floorplans item=floorplan}	
		<a href="floorplans/large/{$floorplan.id}.gif" class='lightbox' title="{$floorplan.caption}" style="width: 85px; height: 85px; vertical-align: middle; text-align: center;">
		<img id='floorplan_{$floorplan.id}' src='floorplans/small/{$floorplan.id}.gif'>
		</a>	
	{foreachelse}
		<p>No Floorplans online</p>
	{/foreach}
	</td>
</tr></table>

<table class=displayTable>
<thead><td>Living Here Comes With</td></thead>
<tr>
	<td>
	{foreach from=$space.family_tags item=tag name=am_loop}		
		<div style='white-space:nowrap; font-size:110%;display:inline;'>{$tag.text},</div>
	{/foreach}
	</td>
</tr></table>


{if $withphone}
	<table class=displayTable id=phone>
	<thead>
		<td>
			Contact {$owner.full_name} 
			{if $owner.company!=''}
				at {$owner.company}
			{/if}
		</td>
	</thead>
	<tr>
		<td>
		{include file='phone_contact.tpl'}
		</td>
	</tr></table>
	
{else}
	<table class=displayTable>
	<thead>
		<td>
			This location is
			{if $space.available>0}
				<b style="color: #0C0;">available!</b>
			{else}
				not available at the moment
			{/if}
		</td>
	</thead>
	<tr>
		<td id='phone'>

		<div style="text-align: center;">
			<p>
				Interested? 
					<a href="#phone" onclick="showPhone('{$space.id}'); return false;">
					Call {$owner.top_name}
					</a>
			</p>
		</div>
		</td>
	</tr></table>

{/if}