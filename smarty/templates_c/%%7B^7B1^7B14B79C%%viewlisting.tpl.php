<?php /* Smarty version 2.6.18, created on 2010-06-06 18:49:09
         compiled from viewlisting.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'viewlisting.tpl', 104, false),)), $this); ?>

<script language="javascript">
<?php echo '

var listingLatLng;

Event.observe(window, \'load\', function() {
	if (document.images)
	{
		star_on 	= new Image(1,1); 
		star_on.src = "./images/star_on.png"; 
		star_off 	= new Image(1,1); 
		star_off.src= "./images/star_off.png"; 
	}
	
	'; ?>

	
	var latitude 	= <?php echo $this->_tpl_vars['location']['latitude']; ?>
;
	var longitude	= <?php echo $this->_tpl_vars['location']['longitude']; ?>
;
	listingLatLng = new GLatLng(latitude, longitude);

	<?php echo '		
	
	var streetview = new GStreetviewPanorama($(\'sv_div\'));
	streetview.setLocationAndPOV( listingLatLng );
});
'; ?>


</script>

<table class=displayTable cellspacing=0>
<tr>
	<td rowspan=2  style="width: 300px;" valign=top> 
		<div id="mapspace">
		<?php if ($this->_tpl_vars['location']['latitude'] != 0): ?>
			<?php if ($this->_tpl_vars['form']['realmap']): ?>
				<div id="map_canvas" style="width: 300px; height: 250px"></div>
				<script language="javascript">
					<?php echo '
					
					Event.observe(window, \'load\', function(){
						
						if(GBrowserIsCompatible())
						{
							var map = new GMap2(document.getElementById("map_canvas"));
							map.setCenter(listingLatLng, 13);
							GEvent.addListener(map,  \'moveend\',  function(){
								map.panTo(listingLatLng);
							});
							var marker = new GMarker(listingLatLng);
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
							
							campus = new GPolygon(campusPoints, \'#CC0000\', 2, .5, \'#FF0000\');
							map.addOverlay(campus)
							
						}
					});
					
					Event.observe(window, \'unload\', function() {
						GUnload();
					});
					'; ?>

				</script>
			<?php else: ?>
				<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&realmap=1">
					<img src="http://maps.google.com/staticmap?zoom=13&size=300x250&key=<?php echo $this->_tpl_vars['google_key']; ?>
&markers=<?php echo $this->_tpl_vars['location']['latitude']; ?>
,<?php echo $this->_tpl_vars['location']['longitude']; ?>
" alt="Map">
				</a>
			<?php endif; ?>
		<?php else: ?>
			<img src='images/unknown_map.gif' style="vertical-align: middle;" alt="Couldn't locate this address on our map">
		<?php endif; ?>
		</div>

		<?php $_from = $this->_tpl_vars['other_spaces_in_location']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['other_spaces'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['other_spaces']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['other_space']):
        $this->_foreach['other_spaces']['iteration']++;
?>
			<?php if (($this->_foreach['other_spaces']['iteration'] <= 1)): ?>
			<div id="otherSpaces" style="display: none;padding-top: 2mm; text-align: center;">
			<div style="font-weight: bold; margin: 3mm 0;">Other Apartments in this Building</div>
			
			<table>
			<?php endif; ?>
				
				<tr>
					<td>
						<?php echo $this->_tpl_vars['other_space']['bedrooms']; ?>
-Bedroom
					</td>
					<td>
						<?php echo $this->_tpl_vars['other_space']['bathrooms']; ?>
-Bathrooms
					</td>
					<td>
						$<?php echo $this->_tpl_vars['other_space']['rent']; ?>

					</td>
					<td>
						($<?php echo ((is_array($_tmp=$this->_tpl_vars['other_space']['rent']/$this->_tpl_vars['other_space']['bedrooms'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
)
					</td>
					<td>
						<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['other_space']['id']; ?>
">
							<img border=0 src='images/go.png' alt="Go">
						</a>
					</td>
				</tr>
				
			<?php if (($this->_foreach['other_spaces']['iteration'] == $this->_foreach['other_spaces']['total'])): ?>
			</table>
			<div  style="text-align: center; margin-top: 3mm;">
			<input type="button" value="Show Map" onclick="$('otherSpaces').hide(); $('mapspace').show();">
			</div>
			</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		
	</td>
	<td valign=top style='width: 285px;'>
		<div class="pageTitle">
			<?php if ($this->_tpl_vars['location']['name'] != ''): ?><?php echo $this->_tpl_vars['location']['name']; ?>
<br><?php endif; ?>
			<?php echo $this->_tpl_vars['location']['address']; ?>

		</div>
		<div class="pseudoHR">&nbsp;</div>
		
		<?php if ($this->_tpl_vars['location']['premium']): ?>
			<div style="font-weight: bold; font-size:90%;">
				<img src="images/star_on.png" width=16 height=16 style="margin-bottom: -3px;"> Featured Listing</div>
			<div class="pseudoHR">&nbsp</div>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['user']['email'] != ''): ?>
			<?php if ($this->_tpl_vars['location_is_starred']): ?>
				<a style="float:right;" href="star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
" onclick="new Ajax.Updater( this,'star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&ajax=1'); return false;">
				<img src="images/house_on.png" width=16 height=16 alt="Un-Star This">
				</a>
			<?php else: ?>
				<a style="float:right;" href="star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
" onclick="new Ajax.Updater( this,'star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&ajax=1'); return false;">
				<img src="images/house_off.png" width=16 height=16 alt="Star This">
				</a>
			<?php endif; ?>
		<?php else: ?>
			<a style="float:right;" href="register.php?type=student&forward=star_listing.php%3Fid%3D<?php echo $this->_tpl_vars['space']['id']; ?>
" class="lbOn">
			<img src="images/house_off.png" width=16 height=16 alt="Star This">
			</a>
		<?php endif; ?>
		
		<table>
			<tr><td>Bedrooms:</td><td><?php echo $this->_tpl_vars['space']['bedrooms']; ?>
</td></tr>
			<tr><td>Bathrooms:</td><td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td></tr>
			<tr><td>Rent:</td><td>$<?php echo $this->_tpl_vars['space']['rent']; ?>
</td></tr>
			<tr><td>Rent per Bedroom:</td><td>$<?php echo ((is_array($_tmp=$this->_tpl_vars['space']['rent']/$this->_tpl_vars['space']['bedrooms'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
		</table>
		
				<div class="pseudoHR">&nbsp;</div>
		
				<?php if ($this->_tpl_vars['space']['available'] > 0): ?>
					<b style="color: #0C0; margin-left: 15mm;">Available now!</b>
				<?php else: ?>
					<div style=" margin-left: 15mm;">(Not available at the moment)</div>
				<?php endif; ?>				
				<?php if ($this->_tpl_vars['withphone'] != true): ?>
				<br>
					<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&withphone=1#phone" onclick="return (showPhone('<?php echo $this->_tpl_vars['space']['id']; ?>
'))? false : false;">
					<img border=0 src='images/red_phone.png' width=16 height=16> Call <?php echo $this->_tpl_vars['owner']['top_name']; ?>

					</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['num_osil'] > 0): ?>
				<br>
				<a href="#" onclick="$('mapspace').hide(); $('otherSpaces').show(); return false;">
				<img border=0 src='images/house_go.png' width=16 height=16> Other Apartments in this Building (<?php echo $this->_tpl_vars['num_osil']; ?>
)
				</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['location']['belongs_to_user_id'] == $this->_tpl_vars['user']['id']): ?>
				<br>
				<a href="editlisting.php?id=<?php echo $this->_tpl_vars['location']['id']; ?>
">
				<img border=0 src='images/wrench.png' width=16 height=16> Edit This Listing
				</a>
				<?php endif; ?>
				<br>
				<a href="http://www.facebook.com/share.php?u=<url>" onclick="return fbs_click()" target="_blank" class="fb_share_link">Tell your roommates</a> about this apartment
				
			<br>
			<br>
				<?php if ($this->_tpl_vars['withphone'] != true): ?>
					<br>
						<div style="text-align: center; font-size: 140%; font-weight: bold;">
						<?php if ($this->_tpl_vars['skip_notice']): ?>
								<a href="#phone" onclick="showPhone('<?php echo $this->_tpl_vars['space']['id']; ?>
'); return false;">
						<?php else: ?>
								<a href="show_notice.php?forward=viewlisting.php%3Fid%3D<?php echo $this->_tpl_vars['space']['id']; ?>
%26withphone" class="lbOn" >
						<?php endif; ?>
						 Contact Landlord!
						</a>
						</div>
				<?php else: ?>
					<br>
						<div style="text-align: center; font-size: 120%;">
						Phone number is at the bottom
						</div>
						
				<?php endif; ?>
	</td>
</tr>
<tr>
	<td>
		<?php if ($this->_tpl_vars['form']['realmap']): ?><div style="float: left;border: 2px solid #CC3333;display: inline; background-color: #FF9999;">Campus</div><?php endif; ?>
	</td>
</tr>
</table>

<table class=displayTable>
<thead><td width=50%>Photos</td><td>Floorplans</td></thead>
<tr>
	<td>
	<?php $_from = $this->_tpl_vars['space']['listing_photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>		
		<a href="photos/large/<?php echo $this->_tpl_vars['photo']['id']; ?>
.jpg" class='lightbox' title="<?php echo $this->_tpl_vars['photo']['caption']; ?>
" style="width: 85px; height: 85px; vertical-align: middle; text-align: center;">
		<img id='photo_<?php echo $this->_tpl_vars['photo']['id']; ?>
' src='photos/small/<?php echo $this->_tpl_vars['photo']['id']; ?>
.jpg'>
		</a>
	<?php endforeach; else: ?>
		<p>No photos available</p>
	<?php endif; unset($_from); ?>
	</td>
	<td>
	<?php $_from = $this->_tpl_vars['space']['visible_floorplans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['floorplan']):
?>	
		<a href="floorplans/large/<?php echo $this->_tpl_vars['floorplan']['id']; ?>
.gif" class='lightbox' title="<?php echo $this->_tpl_vars['floorplan']['caption']; ?>
" style="width: 85px; height: 85px; vertical-align: middle; text-align: center;">
		<img id='floorplan_<?php echo $this->_tpl_vars['floorplan']['id']; ?>
' src='floorplans/small/<?php echo $this->_tpl_vars['floorplan']['id']; ?>
.gif'>
		</a>	
	<?php endforeach; else: ?>
		<p>No Floorplans available</p>
	<?php endif; unset($_from); ?>
	</td>
</tr></table>


<?php $_from = $this->_tpl_vars['space']['family_tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['am_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['am_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tag']):
        $this->_foreach['am_loop']['iteration']++;
?>		
	<?php if (($this->_foreach['am_loop']['iteration'] <= 1)): ?>
	<table class=displayTable>
	<thead><td>Living Here Comes With</td></thead>
	<tr>
		<td>
	<?php endif; ?>
			<div style='white-space:nowrap; font-size:110%;display:inline;'><?php echo $this->_tpl_vars['tag']['text']; ?>
,</div>
	<?php if (($this->_foreach['am_loop']['iteration'] == $this->_foreach['am_loop']['total'])): ?>
		</td>
	</tr></table>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>


<?php if ($this->_tpl_vars['location']['latitude'] != 0): ?>
	<table class=displayTable id=street>
	<thead>
		<td>
			See the neighborhood
		</td>
	</thead>
	<tr>
		<td>
			<div style="width: 400px; height: 250px; float: right;" id="sv_div"></div>
			<div style="font-weight: bold; text-align:center;">Use this to check out the area</div>
			<p style="margin: 2mm 0 0 0;">
				Use this for a 360 degree view
			</p>
			<p style="margin: 2mm 0 0 0;">
				
			<i>But</i><br>
			It may not be pointing the right way
			</p>

		</td>
	</tr>
	</table>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['withphone']): ?>
	<table class=displayTable id=phone>
	<thead>
		<td>
			Contact <?php echo $this->_tpl_vars['owner']['full_name']; ?>
 
			<?php if ($this->_tpl_vars['owner']['company'] != ''): ?>
				at <?php echo $this->_tpl_vars['owner']['company']; ?>

			<?php endif; ?>
		</td>
	</thead>
	<tr>
		<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'phone_contact.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr></table>
	
	<?php echo '
	<script>
		new Effect.ScrollTo(\'phone\', {offset: -100} );}
	</script>
	'; ?>

	
<?php else: ?>
	<table class=displayTable>
	<thead>
		<td>
			This location is
			<?php if ($this->_tpl_vars['space']['available'] > 0): ?>
				<b style="color: #0C0;">available!</b>
			<?php else: ?>
				not available at the moment
			<?php endif; ?>
		</td>
	</thead>
	<tr>
		<td id='phone'>

		<div style="text-align: center;">
			<p>
				Interested? 
			<?php if ($this->_tpl_vars['skip_notice']): ?>
					<a href="#phone" onclick="showPhone('<?php echo $this->_tpl_vars['space']['id']; ?>
'); return false;">
			<?php else: ?>
					<a href="show_notice.php?forward=viewlisting.php%3Fid%3D<?php echo $this->_tpl_vars['space']['id']; ?>
%26withphone" class="lbOn">
			<?php endif; ?>
				Call the landlord</a>

			</p>
			
			<p>Be sure to mention <b>IURentStop.com</b> when asking for a showing!</p>
		</div>
		</td>
	</tr></table>

<?php endif; ?>


<script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $this->_tpl_vars['google_key']; ?>
" type="text/javascript"></script>