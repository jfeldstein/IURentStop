<form id="search_form" action="search.php">
		
		<table style="vertical-align: top;">
		<thead><td>Search Houses and Apartments in Bloomington</td></thead>
		<tr><td><table>
		<tr>
			<td>
			
			<table>
			<tr>
				<td colspan="2" align="center">Search for 
					<select id="location_type" name="location_type">
						{html_options options=$location_type_options selected=$form.location_type }
					</select></td>
			</tr>
			<tr>
				<td>
		
				<table style="vertical-align: top;">
				
				<tr>
					<td>
						<label for="space_bedrooms">Bedrooms:</label>
					</td>
					<td>
						<select id="space_bedrooms" name="space_bedrooms">
							{html_options options=$bedroom_options selected=$form.space_bedrooms }
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="space_bathrooms">Bathrooms:</label>
					</td>
					<td>
						<select id="space_bathrooms" name="space_bathrooms">
							{html_options options=$bathroom_options selected=$form.space_bathrooms }
						</select>
					</td>
				</tr>
				</table>
			</td>
			<td>
				<table>
				<tr>
					<td>
						
						<table>
							<tr><td>Between</td><td> <input type="text" size="4" name="space_rent_min" class="money" value="{$form.space_rent_min}"> </td></tr>
							<tr><td> And</td><td> <input type="text" size="4" name="space_rent_max" class="money" onKeyPress="return numbersonly(this, event);" value="{$form.space_rent_max}"></td></tr>
						</table>
					</td>
				</tr>
				</table>
			</td>

			</tr>
			</table>
			
			</td>
			<td>
				<input type="hidden" name="search_location" id="search_location" value="{$form.search_location}" />
				
				<div>
					<div id="edit_tooltip" style="cursor: pointer; height: 68px; padding-top: 30px;display: none; text-align: center;"><div style="margin:auto; border: 1px solid pink; background-color: white; width: 70px;">Change Location</div></div> 
					<input id="minimap" type="image" name="action" value="" src="{getgooglemapimageurl w=200 h=100 coords=$form.search_location zoom=12}" />
					
					{literal}
					<script type="text/javascript">
					var tt = $('edit_tooltip')
					var mm = $('minimap');
					tt.absolutize().clonePosition(mm, {setHeight: false}).setOpacity(.85);
					Event.observe( mm, 'mouseover', function(){ tt.show() } );
					Event.observe( mm, 'mouseout', function(){ tt.hide() } );
					Event.observe( tt, 'mouseout', function(){ tt.hide() } );
					Event.observe( tt, 'click', function(){ mm.click() } );
					
					
					</script>
					{/literal}
				</div>
				
			</td>
			<td>
				<input type="submit" name="action" value="Search">
			</td>
			</tr>
			
		</table></td></tr>
		
		</table>
		
		
		
		</form>