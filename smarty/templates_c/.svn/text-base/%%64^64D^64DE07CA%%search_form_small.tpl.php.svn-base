<?php /* Smarty version 2.6.18, created on 2009-03-12 18:04:27
         compiled from search_form_small.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'search_form_small.tpl', 13, false),array('function', 'getgooglemapimageurl', 'search_form_small.tpl', 66, false),)), $this); ?>
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
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['location_type_options'],'selected' => $this->_tpl_vars['form']['location_type']), $this);?>

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
				</table>
			</td>
			<td>
				<table>
				<tr>
					<td>
						
						<table>
							<tr><td>Between</td><td> <input type="text" size="4" name="space_rent_min" class="money" value="<?php echo $this->_tpl_vars['form']['space_rent_min']; ?>
"> </td></tr>
							<tr><td> And</td><td> <input type="text" size="4" name="space_rent_max" class="money" onKeyPress="return numbersonly(this, event);" value="<?php echo $this->_tpl_vars['form']['space_rent_max']; ?>
"></td></tr>
						</table>
					</td>
				</tr>
				</table>
			</td>

			</tr>
			</table>
			
			</td>
			<td>
				<input type="hidden" name="search_location" id="search_location" value="<?php echo $this->_tpl_vars['form']['search_location']; ?>
" />
				
				<div>
					<div id="edit_tooltip" style="cursor: pointer; height: 68px; padding-top: 30px;display: none; text-align: center;"><div style="margin:auto; border: 1px solid pink; background-color: white; width: 70px;">Change Location</div></div> 
					<input id="minimap" type="image" name="action" value="" src="<?php echo smarty_function_getgooglemapimageurl(array('w' => 200,'h' => 100,'coords' => $this->_tpl_vars['form']['search_location'],'zoom' => 12), $this);?>
" />
					
					<?php echo '
					<script type="text/javascript">
					var tt = $(\'edit_tooltip\')
					var mm = $(\'minimap\');
					tt.absolutize().clonePosition(mm, {setHeight: false}).setOpacity(.85);
					Event.observe( mm, \'mouseover\', function(){ tt.show() } );
					Event.observe( mm, \'mouseout\', function(){ tt.hide() } );
					Event.observe( tt, \'mouseout\', function(){ tt.hide() } );
					Event.observe( tt, \'click\', function(){ mm.click() } );
					
					
					</script>
					'; ?>

				</div>
				
			</td>
			<td>
				<input type="submit" name="action" value="Search">
			</td>
			</tr>
			
		</table></td></tr>
		
		</table>
		
		
		
		</form>