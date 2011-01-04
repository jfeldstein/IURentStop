{foreach from=$results item='result' name='resultsLoop'}
	
	{if $smarty.foreach.resultsLoop.first}
<br>

			<table>
			<thead><td>Your Results Around Town</td></thead>
			<tr><td>
			
				<div id="results_map_div" style="width: 400px; height: 300px; margin:auto;"></div>
			
				<script language="javascript">
			
				{literal}
				var map;
				var queMarker = function(lat, lng){

					Event.observe(window, 'load', function(){
						map.addOverlay( new GMarker( new GLatLng(lat, lng) ));
					});
				}
				
				Event.observe(window, 'load', function() {

					if(GBrowserIsCompatible())
					{
					{/literal}
					
					btown_center_lat = {$btown_center_lat};
					btown_center_lon = {$btown_center_lon};
					btown = new GLatLng(btown_center_lat, btown_center_lon);
					
					{literal}
						var star = new Image();
						star.src = "./images/star_red_glowing.png";
						
						map = new GMap2(document.getElementById("results_map_div"));
						map.setCenter( btown, 13);
						map.addOverlay( new GMarker(btown));
						map.addControl(new GSmallZoomControl());
					}
				});
				{/literal}
				</script>	
			</td></tr>
			<tr><td></td></tr>
			<tr><td>
			<table>
			<thead> 
				<td colspan="4">
				Available Leases
				</td>
			</thead>
					
	{/if}
		
		<tr>
			
				<td>
				
				<script type="text/javascript">
				
				queMarker({$result.latitude}, {$result.longitude});
				
				</script>
				
					{if $result.photo_id > 0}
					<a href="viewlisting.php?id={$result.space_id}">
						<img src="photos/small/{$result.photo_id}.jpg">
					</a>
					{/if}
				</td>
				<td>
					<a href="viewlisting.php?id={$result.space_id}">
					${$result.rent_per_bedroom} per bedroom
					</a>
				</td>
				<td>
					<a href="viewlisting.php?id={$result.space_id}">
					{$result.bathrooms} bathrooms
					</a>
				</td>
				<td>
					<a href="viewlisting.php?id={$result.space_id}">
					{$result.distance}mi
					</a>
				</td>
		</tr>
	
	
	{if $smarty.foreach.resultsLoop.last}
			</table>
			</td></tr>
			
			</table>
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$google_key}" type="text/javascript"></script>
				
	{/if}
	
{/foreach}