<form action="search.php?search#results" id="search_form" method="POST">

	<input type="hidden" name="location_type" value="apartment" />


	<table class=displayTable>
	<thead><td colspan="2" style="text-align: center;">
		<h1>Bloomington Apartments for Rent</h1>
		<p style='font-size: 130%;'>Pick bedrooms, click the map.</p>
	</td></thead>
		<tr>
			<td style="width: 150px;" valign="top">
				<div class="searchTitle">Size</div>
			</td>
			<td valign="middle" style="padding-left: 5mm;">
					{html_options options=$bedrooms name='space_bedrooms' selected=$form.space_bedrooms}
			</td>
		</tr>
		
		
		<tr>
			<td valign="top" style="width: 150px;">
				<div class="searchTitle">Location</div>
				
				<div style="padding-left: 4mm;">
					{if $form.search_location=='' OR $form.search_location=='#'}
						<br>	<img src="images/arrow_right.png"> Click on the map and we'll show the closest results first
						<input type="hidden" name="search_location" id="search_location" value="#">
					{else}
						<br><img src="images/accept.png"> Locked in!
						<br><div><a href="search.php">New Search</a></div>
						<input type="hidden" name="search_location" id="search_location" value="{$form.search_location}">
					{/if}
				</div>
			</td>
			<td valign="top" style="padding-left: 5mm; height: 315px; width: 489px;">
				
				{if $form.search_location=='' OR $form.search_location=='#'}
					<div id="search_map_div" style="width:400px; height: 300px;position: absolute;z-index:999;">&nbsp;</div>
				{else}
					<img src="http://maps.google.com/staticmap?zoom=13&size=400x300&markers={$form.search_location},red&key={$google_key}" style="width:400px; height: 300px;position: absolute;z-index:999;">
				{/if}
				
			</td>
		</tr>
		
		
		<tr>
			<td colspan=2 style="text-align: center; padding-bottom: 5mm; vertical-align: bottom;">
				<input type=submit name=action value="Show me what you've got!" />
			</td>
		</tr>
		
	</table>
</form>