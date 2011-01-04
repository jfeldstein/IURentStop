<?php /* Smarty version 2.6.18, created on 2009-03-14 23:37:54
         compiled from myproperties.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_from = $this->_tpl_vars['locations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loc_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loc_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['loc']):
        $this->_foreach['loc_loop']['iteration']++;
?>
	<?php if (($this->_foreach['loc_loop']['iteration'] <= 1)): ?>
		<table  class="spaceTable" cellspacing=0>
		<thead>
			<td>Address</td>
			<td style="width: 100px;">Bedrooms</td>
			<td style="width: 100px;">Bathrooms</td>
			<td style="width: 100px;">Rent</td>
			<td style="width: 100px;">Available</td>
		</thead>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['loc']['type'] == 'apartment'): ?>
		<?php $_from = $this->_tpl_vars['loc']['spaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['space_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['space_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['space']):
        $this->_foreach['space_loop']['iteration']++;
?>
			<tr onclick="document.location='editlisting.php?id=<?php echo $this->_tpl_vars['loc']['id']; ?>
';">

				<?php if (($this->_foreach['space_loop']['iteration'] <= 1)): ?>
					<td style="height: 25px;">
						<?php echo $this->_tpl_vars['loc']['address']; ?>

					</td>
				<?php else: ?>
					<td style="text-align: center;">
						&quot;
					</td>
				<?php endif; ?>
				<td><?php echo $this->_tpl_vars['space']['bedrooms']; ?>
</td>
				<td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td>
				<td>$<?php echo $this->_tpl_vars['space']['rent']; ?>
</td>
				<td><?php if ($this->_tpl_vars['space']['available'] > 0): ?>Yes<?php else: ?>No<?php endif; ?></td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<tr onclick="document.location='editlisting.php?id=<?php echo $this->_tpl_vars['loc']['id']; ?>
';">
			<td><?php echo $this->_tpl_vars['loc']['address']; ?>
</td>
			<td><?php echo $this->_tpl_vars['loc']['spaces'][0]['bedrooms']; ?>
</td>
			<td><?php echo $this->_tpl_vars['loc']['spaces'][0]['bathrooms']; ?>
</td>
			<td>$<?php echo $this->_tpl_vars['loc']['spaces'][0]['rent']; ?>
</td>
			<td><?php if ($this->_tpl_vars['loc']['spaces'][0]['available'] == 1): ?>Yes<?php else: ?>No<?php endif; ?></td>
		</tr>
	<?php endif; ?>
	
	<?php if (($this->_foreach['loc_loop']['iteration'] == $this->_foreach['loc_loop']['total'])): ?>
		<tr>
			<td colspan=5 align=right>
				<a href="addlisting.php" style="display: block;">
					Add New Listing <img src="images/add.png">
				</a>
			</td>
		</tr>
		</table>
	<?php endif; ?>
<?php endforeach; else: ?>
	<?php if ($this->_tpl_vars['user']['complete_contact']): ?>
		<table class="displayTable" cellspacing="0">
			<thead><td colspan=2>You don't have any properties listed</td></thead>
			<tr>
				<td colspan=2>
					<p>Listing on RentStop is free and it takes only a few minutes to get started.</p>
					<br>
					<p>Go ahead, knock yourself out:</p>
					<div class="pseudoHR">&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td width=50% style="padding-right: 5mm;">
					<input type="button" value="List an Apartment" style="float:right;" onclick="document.location='addlisting.php?location_type=apartment';">
					<b>Apartments</b> <br style='clear:both;'>
					Apartments have multiple rentable spaces that can each 
					have their own lease agreement. This includes a house whose rooms 
					you're leasing separately.
				</td>
				<td style="vertical-align: top;">
					<input type="button" value="List a House" style="float:right;" onclick="document.location='addlisting.php?location_type=house';">
					<b>Houses</b> <br style='clear:both;'> Houses only have one space being rented at the address
				</td>
			</tr>
		</table>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'prompt_for_contact.tpl', 'smarty_include_vars' => array('forward' => $this->_tpl_vars['forward'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endif; unset($_from); ?>