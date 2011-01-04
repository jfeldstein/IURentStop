<?php /* Smarty version 2.6.18, created on 2010-06-06 13:55:36
         compiled from saved_spaces.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'saved_spaces.tpl', 45, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['saved_spaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['space_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['space_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['space']):
        $this->_foreach['space_loop']['iteration']++;
?>
	<?php if (($this->_foreach['space_loop']['iteration'] <= 1)): ?>
		<table  class="displayTable" cellspacing=0>
		<thead>
			<td align=center colspan=7>Watched Listings</td>
		</thead>
		<thead>
			<td></td>
			<td></td>
			<td colspan=2 style='text-align: right;'>Bedrooms</td>
			<td colspan=2>Bathrooms</td>
			<td></td>
		</thead>
		<thead>
			<td></td>
			<td></td>
			<td>Address</td>
			<td style="text-align: left; padding-right: 2mm;">&darr;</td>
			<td style="text-align: left; padding-left: 2mm;">&darr;</td>
			<td>Rent (Per Bedroom)</td>
			<td></td>
		</thead>
	<?php endif; ?>
		<tr>
			<td>
				<?php if ($this->_tpl_vars['space']['random_photo']['id']): ?>
					<img src="photos/small/<?php echo $this->_tpl_vars['space']['random_photo']['id']; ?>
.jpg">
				<?php endif; ?>
			</td>
			<td valign="middle">
				<a href="star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
" onclick="new Ajax.Updater( this,'star_listing.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
&ajax=1'); return false;">
				<img src="images/house_on.png" alt="Stop Watching This">
				</a>
			</td>
			<td>
				<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
" class="result">
					<?php if ($this->_tpl_vars['space']['name'] != ''): ?>
						<div class="result_name"><?php echo $this->_tpl_vars['space']['name']; ?>
</div>
					<?php endif; ?>
					<div class='result_address'><?php echo $this->_tpl_vars['space']['address']; ?>
</div>
				</a>
			</td>
			<td><?php echo $this->_tpl_vars['space']['bedrooms']; ?>
</td>
			<td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td>
			<td><?php echo $this->_tpl_vars['space']['rent']; ?>
 ($<?php echo ((is_array($_tmp=$this->_tpl_vars['space']['rent']/$this->_tpl_vars['space']['bedrooms'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
)</td>
			<td>
				<a href="viewlisting.php?id=<?php echo $this->_tpl_vars['space']['id']; ?>
" class="result">
					Details
				</a>
			</td>
		</tr>
	<?php if (($this->_foreach['space_loop']['iteration'] == $this->_foreach['space_loop']['total'])): ?>
		</table>
	<?php endif; ?>
<?php endforeach; else: ?>
	<table class="displayTable">
	<thead><td>Watched Listings</td></thead>
	<tr><td>
		<p>
			<b>You aren't watching any listings!</b>
			<a href="search.php">Get searching,</a> and find the house for you. 
		</p>
		<p>
			<img src="images/house_off.png" alt="House"> If something looks interesting, 
			click the house to save it to this list.		
		</p>
	</td></tr></table>
<?php endif; unset($_from); ?>