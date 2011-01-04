<table class=displayTable cellspacing=0>
<tr>
	<td rowspan=2>
		{if $location.latitude!=0}
			<div id="map_canvas" style="width: 300px; height: 250px"></div>
			<script language="javascript">
				var latitude 	= {$location.latitude};
				var longitude	= {$location.longitude};
				{literal}
				if(GBrowserIsCompatible())
				{
					var map = new GMap2(document.getElementById("map_canvas"));
					map.setCenter(new GLatLng(latitude, longitude), 14);
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
		{/if}
	</td>
	<td valign=top style='width: 285px;'>
		<div class="pageTitle">
			{if $location.name!=''}{$location.name}<br>{/if}
			{$location.address}
		</div>
		
		<table>
			<tr><td>Bedrooms:</td><td>{$space.bedrooms}</td></tr>
			<tr><td>Bathrooms:</td><td>{$space.bathrooms}</td></tr>
			<tr><td>Rent:</td><td>${$space.rent}</td></tr>
			<tr><td>Rent per Bedroom:</td><td>${$space.rent/$space.bedrooms}</td></tr>
			<tr><td colspan=2 align=center>
				{if $space.available>0}
					<b style="color: #0C0;">Available now!</b>
					{if $withphone!=true}
					<br>
						<a href="viewlisting.php?id={$space.id}&withphone#phone">
						Call {$owner.top_name} to see it
						</a>
					{/if}
				{else}
					(Not available at the moment)
					{if $withphone!=true}
						<br>
						<a href="viewlisting.php?id={$space.id}&withphone#phone">
						Call {$owner.top_name} to ask about it
						</a>
					{/if}
				{/if}
			</td></tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<div style="border: 2px solid #CC3333;display: inline; background-color: #FF9999;">Campus</div>
	</td>
</tr>
</table>

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
		<table>
		<tr><td style="font-weight:bold; font-size: 120%;" width=80>Call:</td><td>{$properphone}</td></tr>
		<tr><td style="font-weight:bold; font-size: 120%;">Ask For:</td><td>{$owner.full_name}</td></tr>
		<tr><td colspan=2 style="font-weight:bold; font-size: 120%;">Tell them:</td></tr>
		<tr><td colspan=2>
			<blockquote>
				{if $location.type=='house'}
					<div style="">
						I saw you have 
						{if $location.name==''} a house {else} <span style='white-space:nowrap; font-weight:bold;'>'{$location.name}'</span> {/if}
						at <span style='white-space:nowrap; font-weight:bold;'>'{$location.address}'</span> listed on IURentStop.com.
					</div>
				{else}
					<div style="">
						I saw you have a {$space.bedrooms}-bedroom, 
						{$space.bathrooms}-bathroom, apartment 
						
						{if $location.name!=''}
							in <span style='white-space:nowrap; font-weight:bold;'>'{$location.name}'</span>
						{/if}
						
						at <span style='white-space:nowrap; font-weight:bold;'>'{$location.address}' </span>
						
						listed on IURentStop.com.
					</div>
				{/if}
				<div style="">I'm interested in knowing more about it, and maybe seeing it.</div>
			</blockquote>
			<p>Good luck getting the place you want!</p>
		</td></tr>
	</table>

	</td>
	</tr></table>
	
{else}
<div style="text-align: center;">
	This location is:
	{if $space.available>0}
		<b style="color: #0C0;">Available now!</b>
	{else}
		not available to rent at the moment
	{/if}
	<p>
		Interested? 
		<a href="viewlisting.php?id={$space.id}&withphone#phone">
		Call {$owner.top_name} to schedule a showing
		</a>
	</p>
</div>
{/if}

