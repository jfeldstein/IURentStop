<?php /* Smarty version 2.6.18, created on 2010-06-06 14:48:42
         compiled from _photos_form.tpl */ ?>
<?php if ($this->_tpl_vars['object_photos_total'] < 2): ?>
	<div style="background-color:#DDD; border-bottom:1px solid #000; padding-left:3mm;margin-bottom:3mm;">
			<form action="photomanager.php" method="post" enctype='multipart/form-data' onsubmit="return AIM.submit(this, <?php echo '{\'onStart\': getCaption, \'onComplete\':completeCallback }'; ?>
);">
				<input type='submit' value='Add this photo:'> 
				<input type='file' id='item_data' name='item_data'>
				<input type='hidden' name='target_type' value='<?php echo $this->_tpl_vars['target_type']; ?>
'>
				<input type='hidden' name='target_id' value='<?php echo $this->_tpl_vars['target_id']; ?>
'>
				<input type='hidden' name='action' value='addphoto'>
				<input type='hidden' name='caption' id='caption'>
			</form>
	</div>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['obj']['all_photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['photo_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['photo_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['photo']):
        $this->_foreach['photo_loop']['iteration']++;
?>
	<?php if (($this->_foreach['photo_loop']['iteration'] <= 1)): ?>
		<table class="displayTable" style='width: 90%; margin-left: 5mm;'>
		<thead>
			<td>
		<?php if ($this->_tpl_vars['location']['type'] == 'house'): ?>
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
			<?php if (0): ?>
			Total Photos: <?php echo $this->_tpl_vars['photos_total']; ?>
 (<?php echo $this->_tpl_vars['photos_visible_total']; ?>
 shown, using <?php echo $this->_tpl_vars['credits_used']; ?>
 of <?php echo $this->_tpl_vars['credits']; ?>
 extra photos allowed)<br>
			Photos Shown Here: <?php echo $this->_tpl_vars['object_photos_total']; ?>
 (<?php echo $this->_tpl_vars['object_photos_visible']; ?>
 are shown on this listing)<br>
			<?php endif; ?>
	<?php endif; ?>
	<table style='display: inline; width: 80px;'>
	<tr><td>
		<img id='photo_<?php echo $this->_tpl_vars['photo']['id']; ?>
' src='photos/small/<?php echo $this->_tpl_vars['photo']['id']; ?>
.jpg' class='imageBtn <?php if ($this->_tpl_vars['photo']['visible']): ?>visible<?php elseif ($this->_tpl_vars['photo']['active']): ?>withheld<?php else: ?>off<?php endif; ?>'>
	</td></tr>
	<tr><td style='font-size:10px;margin-top:-1mm; text-align: center; width: 80px; argin: auto;'>
			&quot; <?php echo $this->_tpl_vars['photo']['caption']; ?>
 &quot;
			<br>
			<a href='#' onclick="delete_image('<?php echo $this->_tpl_vars['photo']['id']; ?>
')">Delete</a>
			-
			<a href='#' onclick="recaption_image('<?php echo $this->_tpl_vars['photo']['id']; ?>
')">Edit</a>
	</td></tr></table>
	
	<?php if (($this->_foreach['photo_loop']['iteration'] == $this->_foreach['photo_loop']['total'])): ?>
		</td></tr></table>
	<?php endif; ?>
<?php endforeach; else: ?>
	<div style="font-weight: bold; margin: -3mm 0 3mm 2.5cm;">
		Find a photo to upload
		<img src="images/arrow_curve_left_up.gif">
	</div>
	
<?php endif; unset($_from); ?>
