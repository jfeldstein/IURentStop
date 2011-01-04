<?php /* Smarty version 2.6.18, created on 2009-03-12 18:04:27
         compiled from results.tpl */ ?>
<?php $_from = $this->_tpl_vars['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['resultsLoop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['resultsLoop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['result']):
        $this->_foreach['resultsLoop']['iteration']++;
?>
	
	<?php if (($this->_foreach['resultsLoop']['iteration'] <= 1)): ?>
<br>

			<table>
			<thead><td>Your Results Around Town</td></thead>
			<tr><td>
			
				<div id="results_map_div" style="width: 400px; height: 300px; margin:auto;"></div>
			
				<script language="javascript">
			
				<?php echo '
				var map;
				var queMarker = function(lat, lng){

					Event.observe(window, \'load\', function(){
						map.addOverlay( new GMarker( new GLatLng(lat, lng) ));
					});
				}
				
				Event.observe(window, \'load\', function() {

					if(GBrowserIsCompatible())
					{
					'; ?>

					
					btown_center_lat = <?php echo $this->_tpl_vars['btown_center_lat']; ?>
;
					btown_center_lon = <?php echo $this->_tpl_vars['btown_center_lon']; ?>
;
					btown = new GLatLng(btown_center_lat, btown_center_lon);
					
					<?php echo '
						var star = new Image();
						star.src = "./images/star_red_glowing.png";
						
						map = new GMap2(document.getElementById("results_map_div"));
						map.setCenter( btown, 13);
						map.addOverlay( new GMarker(btown));
						map.addControl(new GSmallZoomControl());
					}
				});
				'; ?>

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
					
	<?php endif; ?>
		
		<tr>
			
				<td>
				
				<script type="text/javascript">
				
				queMarker(<?php echo $this->_tpl_vars['result']['latitude']; ?>
, <?php echo $this->_tpl_vars['result']['longitude']; ?>
);
				
				</script>
				
					<?php if ($this->_tpl_vars['result']['photo_id'] > 0): ?>
					<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['result']['space_id']; ?>
">
						<img src="photos/small/<?php echo $this->_tpl_vars['result']['photo_id']; ?>
.jpg">
					</a>
					<?php endif; ?>
				</td>
				<td>
					<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['result']['space_id']; ?>
">
					$<?php echo $this->_tpl_vars['result']['rent_per_bedroom']; ?>
 per bedroom
					</a>
				</td>
				<td>
					<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['result']['space_id']; ?>
">
					<?php echo $this->_tpl_vars['result']['bathrooms']; ?>
 bathrooms
					</a>
				</td>
				<td>
					<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['result']['space_id']; ?>
">
					<?php echo $this->_tpl_vars['result']['distance']; ?>
mi
					</a>
				</td>
		</tr>
	
	
	<?php if (($this->_foreach['resultsLoop']['iteration'] == $this->_foreach['resultsLoop']['total'])): ?>
			</table>
			</td></tr>
			
			</table>
		<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>
				
	<?php endif; ?>
	
<?php endforeach; endif; unset($_from); ?>