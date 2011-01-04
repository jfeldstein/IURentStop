<?php /* Smarty version 2.6.18, created on 2009-03-14 23:32:17
         compiled from editlisting_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'editlisting_form.tpl', 53, false),)), $this); ?>
<script language="javascript">
	<?php echo '
	Event.observe(window, \'load\', function() {
		tagSuggestions = new Ajax.Autocompleter(\'new_tag\', \'suggestionBox\', \'tagSuggest.php\', {\'frequency\':.3});
		$(\'new_tag\').focus();
	});
	'; ?>

</script>

<table class="displayTable">
<tr>
	<td width="60%">
		<div class="pageTitle" style="padding-bottom: 0; margin-bottom:0;">
			<?php if ($this->_tpl_vars['location']['name'] != ''): ?><?php echo $this->_tpl_vars['location']['name']; ?>
<br><?php endif; ?>
			<?php echo $this->_tpl_vars['location']['address']; ?>
 <br>
		</div>
	</td>
	<td>
		<a href="welcome.php">Back</a>
	</td>
	<td>
		<a href="savelocation.php?id=<?php echo $this->_tpl_vars['location']['id']; ?>
&delete=1"  onclick="return confirm('Are you sure you want to delete this entire listing?\n\n\t\tThere is no undo.');" style="float:right;"><img src="./images/delete.png" style="vertical-align: text-bottom; " valign="middle">Delete Listing</a>
	</td>
		
	<?php if ($this->_tpl_vars['location']['premium']): ?>
		<tr>
			<td colspan=3>
			<div class="pseudoHR">&nbsp;</div>
			<div style="font-size: 80%; text-align: center;"><b>Featured Listing</b> - Show first in search results, and highlighed to stand out from the rest</div>
			</td>
		</tr>
	<?php endif; ?>
</tr>
</table>

<table class="displayTable">
<thead>
	<td>Building Details</td>
	<td>Building Amenities</td>
</thead>
<tr>
	<td valign="top">
		<form action="savelocation.php">
		<table>
		<tr><td>Name:</td>
			<td>
				<input type="text" name='location_name' value='<?php echo $this->_tpl_vars['location']['name']; ?>
'>
				<img src="images/help.png" onmouseover="tooltip.show('Does this property have a nickname that students are more likely to recognize than its address?', 200);" onmouseout="tooltip.hide();">
			</td></tr>
		<tr><td>Address:</td><td><input type="text" name='location_address' value='<?php echo $this->_tpl_vars['location']['address']; ?>
'></td></tr>
		<tr><td>Building:</td><td>
			<select name="location_type">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['house_or_apartment'],'selected' => $this->_tpl_vars['location']['type']), $this);?>

			</select>
		</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" value="Save Address"></td></tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['location']['id']; ?>
">
		</form>
		
		<br><br>
	</td>
	<td valign="top" align="center">
		
		<div id="tagList">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_taglist.tpl", 'smarty_include_vars' => array('tags' => $this->_tpl_vars['location']['tags'],'form' => $this->_tpl_vars['form'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<b>Add an Amenity:</b>
		<form action="edittags.php" method="POST" id="tagform" onsubmit="return AjaxForm(this, $('tagList'));">
		<input type="text" name="new_tag" id="new_tag" size="35" onkeypress="return commaSubmit(this, event);"/><input type="submit" value="Add">
		<div style="font-size: 80%; font-style: italic;">Type a word to see suggestions</div>
		<div id="suggestionBox"></div>
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="on" value="location">
		<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['location']['id']; ?>
">
		</form>
	</td>
</tr></table>
<form action="savespace.php">	

<table class="displayTable">
<thead>
	<td colspan=6 style="text-align: center;">
		Units at this address
	</td>
</thead>
<thead>
	<td style="width:80px;">Bedrooms</td>
	<td style="width:80px;">Baths</td>
	<td style="width:80px;">Rent</td>
	<td style="width: 140px;">Size</td>
	<td style="width:100px;">Available</td>
	<td style="width:200px;">&nbsp;</td>
</thead>
<?php $_from = $this->_tpl_vars['location']['spaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['space_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['space_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['space']):
        $this->_foreach['space_loop']['iteration']++;
?>
	<?php if ($this->_tpl_vars['edit_space_id'] == $this->_tpl_vars['space']['id']): ?>
		<tr>
			<td><input type="text" name="space_bedrooms" value="<?php echo $this->_tpl_vars['space']['bedrooms']; ?>
" size="2" onkeypress="return numbersonly(this, event);"></td>
			<td><input type="text" name="space_bathrooms" value="<?php echo $this->_tpl_vars['space']['bathrooms']; ?>
" size="3" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_rent" value="<?php echo $this->_tpl_vars['space']['rent']; ?>
" class="money" size="6" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_sqfootage" value="<?php echo $this->_tpl_vars['space']['sqfootage']; ?>
" size="7" onkeypress="return numbersonly(this, event);"><span style="font-size: 80%;">sq feet</style></td>
			<td><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['yesno'],'name' => 'space_available','selected' => $this->_tpl_vars['space']['available']), $this);?>
</td>
			<td>
				<input type="submit" name="action" value="Save">
				-
				<input type="button" value="Cancel" onclick="window.history.go(-1)">
				-
				<a href="savespace.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&action=delete" onclick="return confirm('Are you sure you want to delete this entire listing?\n\n\t\tThere is no undo.');"><img src="images/delete.png" style="vertical-align: middle;" alt="Delete"></a>
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['space']['id']; ?>
">
			</td>
		</tr>
	<?php else: ?>
		<tr>
			<td><?php echo $this->_tpl_vars['space']['bedrooms']; ?>
</td>
			<td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td>
			<td>$<?php echo $this->_tpl_vars['space']['rent']; ?>
</td>
			<td><?php if ($this->_tpl_vars['space']['sqfootage'] > 0): ?><?php echo $this->_tpl_vars['space']['sqfootage']; ?>
 <span style="font-size: 80%;">sq feet</style><?php endif; ?></td>
			<td><?php if ($this->_tpl_vars['space']['available'] > 0): ?>Yes!<?php else: ?>No<?php endif; ?></td>
			<td>
				<a href="editlisting.php?id=<?php echo $this->_tpl_vars['location']['id']; ?>
&sid=<?php echo $this->_tpl_vars['space']['id']; ?>
">Edit</a> 
					
				<?php if (0): ?>
					-
					<a href="reports.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
">Reports</a>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['location']['type'] == 'apartment' || $this->_foreach['space_loop']['total'] > 1): ?>
					- 
					<a href="#" onclick="return pop_tags('edittags.php?on=space&id=<?php echo $this->_tpl_vars['space']['id']; ?>
');" >Amenities</a>
				<?php endif; ?>
			</td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['edit_space_id'] == 'new'): ?>
		<tr>
			<td><input type="text" name="space_bedrooms" value="<?php echo $this->_tpl_vars['form']['space_bedrooms']; ?>
" size="7" onkeypress="return numbersonly(this, event, false);"></td>
			<td><input type="text" name="space_bathrooms" value="<?php echo $this->_tpl_vars['form']['space_bathrooms']; ?>
" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_rent" value="<?php echo $this->_tpl_vars['form']['space_rent']; ?>
" class="money" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_sq_footage" value="<?php echo $this->_tpl_vars['space']['sq_footage']; ?>
" size="4" onkeypress="return numbersonly(this, event);">sq feet</td>
			<td><?php echo smarty_function_html_options(array('style' => "width: 50px;",'options' => $this->_tpl_vars['yesno'],'name' => 'space_available','selected' => $this->_tpl_vars['form']['space_available']), $this);?>
</td>
			<td>
				<input type="submit" name="action" value="Save">
			-
			<input type="button" value="Cancel" onclick="window.history.go(-1)">
				<input type="hidden" name="id" value="new">
				<input type="hidden" name="location_id" value="<?php echo $this->_tpl_vars['location']['id']; ?>
">
			</td>
		</tr>
<?php else: ?>
	<tr id="newSpaceRow"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><a href="editlisting.php?id=<?php echo $this->_tpl_vars['location']['id']; ?>
&sid=new">New</a></td></tr>
<?php endif; ?>
</table>

</form>



<table class="displayTable">
<thead>
	<td colspan=2 style="text-align: center;">
		Add to Listings
	</td>
</thead>
<tr>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editfloorplans.php?location_id=<?php echo $this->_tpl_vars['location']['id']; ?>
')" value="Add Floorplans">
	</td>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editphotos.php?location_id=<?php echo $this->_tpl_vars['location']['id']; ?>
')" value="Add Photos">
	</td>
</tr>
</table>