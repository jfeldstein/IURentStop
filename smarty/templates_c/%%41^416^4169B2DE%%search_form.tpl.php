<?php /* Smarty version 2.6.18, created on 2009-03-12 00:01:27
         compiled from search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'search_form.tpl', 15, false),)), $this); ?>
<?php if ($this->_tpl_vars['search_performed']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "search_form_small.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
		<form id="search_form" action="search.php">
		
		<table style="vertical-align: top; width: 370px;">
		<thead><td colspan="2">Find a Place to Rent:</td></thead>
		<tr>
			<td>
				What:
			</td>
			<td>
					
					<select id="location_type" name="location_type">
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['location_type_options'],'selected' => $this->_tpl_vars['form']['location_type']), $this);?>

					</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="space_bedrooms">Bedrooms:</label>
			</td>
			<td>
				<select id="space_bedrooms" name="space_bedrooms">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['bedroom_options'],'selected' => $this->_tpl_vars['form']['space_bedrooms']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="space_bathrooms">Bathrooms:</label>
			</td>
			<td>
				<select id="space_bathrooms" name="space_bathrooms">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['bathroom_options'],'selected' => $this->_tpl_vars['form']['space_bathrooms']), $this);?>

				</select>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label>Rent:</label><br>
				<div style="font-size:80%;">(per person)</div>
			</td>
			<td>
				<table>
					<tr><td>Between</td><td> <input type="text" size="4" name="space_rent_min" class="money" value="<?php echo $this->_tpl_vars['form']['space_rent_min']; ?>
"> </td></tr>
					<tr><td> And</td><td> <input type="text" size="4" name="space_rent_max" class="money" onKeyPress="return numbersonly(this, event);" value="<?php echo $this->_tpl_vars['form']['space_rent_max']; ?>
"></td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<label>
					Where
				</label>
			</td>
			<td align="left">
				<noscript><i>(Location needs Javascript)</i></noscript>
				<div id="search_map_div"></div>
				<input type="hidden" name="search_location" id="search_location" value="<?php echo $this->_tpl_vars['form']['search_location']; ?>
" />
						
				<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
				<script language="javascript">
				
				btown_center_lat = <?php echo $this->_tpl_vars['btown_center_lat']; ?>
;
				btown_center_lon = <?php echo $this->_tpl_vars['btown_center_lon']; ?>
;
				btown = new GLatLng(btown_center_lat, btown_center_lon);
				
				last_location = null;
				last_coords = $('search_location').value.split(',');
				if(last_coords.length == 2)
					last_location = new GLatLng(last_coords[0], last_coords[1]);
				
				<?php echo '
				
				$(\'search_map_div\').setStyle({
					width: \'250px\',
					height: \'250px\'
				});
				
				Event.observe(window, \'load\', function() {
				
					if(GBrowserIsCompatible())
					{
						var star = new Image();
						star.src = "./images/star_red.png";
						
						var map = new GMap2(document.getElementById("search_map_div"));
						map.setCenter( btown, 13);
						map.addControl(new GSmallZoomControl());
						var addStar = function(point){
							star_icon = new GIcon(G_DEFAULT_ICON, \'./images/star_red.png\');
							star_icon.iconSize = new GSize(86,86);
							star_icon.iconAnchor = new GPoint(43,43);
							star_icon.shadow = null;
							map.addOverlay(new GMarker(point, star_icon, true));
				            
							$(\'search_location\').value = String(point.lat())+\',\'+String(point.lng());
						}
						
						GEvent.addListener(map, "click", function(overlay, point){
							map.clearOverlays();
							if (point) { addStar(point); }
						});
						
						var startingPoint = (last_location != null) ? last_location : btown;
						addStar(startingPoint);
					}
				});
				'; ?>

				</script>
			</td>
		</tr>
		<tr><td></td><td>
			<input type="submit" name="action" value="Find a home"></td></tr>
		</table>
		
	</form>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "results.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>