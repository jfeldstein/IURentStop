<?php /* Smarty version 2.6.18, created on 2010-06-06 14:47:55
         compiled from _floorplan_form.tpl */ ?>
<div style="background-color:#DDD; border-bottom:1px solid #000; padding-left:3mm;margin-bottom:3mm;">
		<form action="floorplanmanager.php" method="post" enctype='multipart/form-data' onsubmit="return AIM.submit(this, <?php echo '{\'onStart\': getCaption, \'onComplete\':completeCallback }'; ?>
);">
			<input type='submit' value='Add this floorplan:'> 
			<input type='file' id='item_data' name='item_data'>
			<input type='hidden' name='target_type' value='space'>
			<input type='hidden' name='target_id' value='<?php echo $this->_tpl_vars['target_id']; ?>
'>
			<input type='hidden' name='action' value='addfloorplan'>
			<input type='hidden' name='caption' id='caption'>
		</form>
</div>
<?php $_from = $this->_tpl_vars['obj']['all_floorplans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['floorplan_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['floorplan_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['floorplan']):
        $this->_foreach['floorplan_loop']['iteration']++;
?>
	<?php if (($this->_foreach['floorplan_loop']['iteration'] <= 1)): ?>
		<table class="displayTable" style='width: 90%; margin-left: 5mm;'>
		<thead>
			<td>
			<?php if ($this->_tpl_vars['obj']['type'] == 'house'): ?>
			<?php if ($this->_tpl_vars['target_type'] == 'location'): ?>
				The House's Exterior
			<?php else: ?>
				The House's Interior
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['target_type'] == 'location'): ?>
				The Building's Exterior
			<?php else: ?>
				The Interior of the <?php echo $this->_tpl_vars['obj']['bedrooms']; ?>
Br, <?php echo $this->_tpl_vars['obj']['bathrooms']; ?>
Bath, $<?php echo $this->_tpl_vars['obj']['rent']; ?>
 Apartment
			<?php endif; ?>
		<?php endif; ?>
			</td>
		</thead>
		<tr><td>
			Floorplans of This Apartment: <?php echo $this->_tpl_vars['floorplans_total']; ?>
<br>
			<?php echo $this->_tpl_vars['floorplans_visible_total']; ?>
 of them are shown to the public. <br>
	<?php endif; ?>
	<table style='display: inline; width: 80px;'>
	<tr><td>
		<img id='floorplan_<?php echo $this->_tpl_vars['floorplan']['id']; ?>
' src='floorplans/small/<?php echo $this->_tpl_vars['floorplan']['id']; ?>
.gif' class='imageBtn <?php if ($this->_tpl_vars['floorplan']['visible']): ?>visible<?php endif; ?>'>
	</td></tr>
	<tr><td style='font-size:10px;margin-top:-1mm; text-align: center; width: 80px; argin: auto;'>
			&quot;<?php echo $this->_tpl_vars['floorplan']['caption']; ?>
&quot;
			<br>
			<a href='#' onclick="delete_image('<?php echo $this->_tpl_vars['floorplan']['id']; ?>
')">Delete</a>
			-
			<a href='#' onclick="recaption_image('<?php echo $this->_tpl_vars['floorplan']['id']; ?>
')">Edit</a>
	</td></tr></table>
	<?php if (($this->_foreach['floorplan_loop']['iteration'] == $this->_foreach['floorplan_loop']['total'])): ?>
		</td></tr></table>
	<?php endif; ?>
<?php endforeach; else: ?>
	<div style="font-weight: bold; margin: -3mm 0 3mm 2.5cm;">
		Find a floorplan to upload
		<img src="images/arrow_curve_left_up.gif">
	</div>
	
<?php endif; unset($_from); ?>
