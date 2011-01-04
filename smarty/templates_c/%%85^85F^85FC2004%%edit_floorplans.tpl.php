<?php /* Smarty version 2.6.18, created on 2010-06-06 14:47:32
         compiled from edit_floorplans.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'json', 'edit_floorplans.tpl', 12, false),)), $this); ?>
<script language="javascript">
managerType = 'floorplan';
</script>

<div id='links' style='text-align:center;margin-bottom:0;'>
	<?php echo '
	<select onchange="update_manager();" id="targeter">
	'; ?>

		<option value='#'>Add floorplans for...</option>
		
		<?php if ($this->_tpl_vars['location']['type'] == 'house'): ?>
			<option value="<?php echo make_json(array('target_type' => 'space','target_id' => $this->_tpl_vars['location']['spaces'][0]['id']), $this);?>
">The House's Interior</option>
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['location']['spaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['space']):
?>
				<option value="<?php echo make_json(array('target_type' => 'space','target_id' => $this->_tpl_vars['space']['id']), $this);?>
">Apartment: <?php echo $this->_tpl_vars['space']['bedrooms']; ?>
Br <?php echo $this->_tpl_vars['space']['bathrooms']; ?>
Bath $<?php echo $this->_tpl_vars['space']['rent']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</select>
</div>

<div id="theDiv">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_floorplan_default.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>