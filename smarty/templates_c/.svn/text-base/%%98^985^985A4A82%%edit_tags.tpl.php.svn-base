<?php /* Smarty version 2.6.18, created on 2009-03-12 00:29:51
         compiled from edit_tags.tpl */ ?>
<script language="javascript">
	<?php echo '
	Event.observe(window, \'load\', function() {
		tagSuggestions = new Ajax.Autocompleter(\'new_tag\', \'suggestionBox\', \'tagSuggest.php\', {});
		$(\'new_tag\').focus();
	});
	'; ?>

</script>

<div class="pageTitle">
	<?php if ($this->_tpl_vars['location']['name'] != ''): ?><?php echo $this->_tpl_vars['location']['name']; ?>
<br><?php endif; ?>
	<?php echo $this->_tpl_vars['location']['address']; ?>

</div>

<table width="100%"><tr><td valign="top">
	<div style="margin: 1mm; border: 1px solid black; background-color: #FFF; padding: 1mm;">
		<?php if ($this->_tpl_vars['form']['on'] == 'space'): ?>
		<b>Amenities for:</b>
			<table>
			<tr><td width="110px">Bedrooms</td><td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td></tr>
			<tr><td>Bathrooms</td><td><?php echo $this->_tpl_vars['space']['bathrooms']; ?>
</td></tr>
			<tr><td>Rent</td><td>$<?php echo $this->_tpl_vars['space']['rent']; ?>
</td></tr>
			<tr><td>Available?</td><td><?php if ($this->_tpl_vars['space']['available']): ?>Yes<?php else: ?>No<?php endif; ?></td></tr>
			</table>
		<?php else: ?>
		<?php if ($this->_tpl_vars['location']['type'] == 'apartment'): ?><p>These amenities are for this address as well as all apartments that are part of it</p><?php endif; ?>
		<?php endif; ?>
	</div>
</td><td valign="top" align="center">

<b>Current Amenities:</b><br>


		<div id="tagList">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_taglist.tpl", 'smarty_include_vars' => array('tags' => $this->_tpl_vars['tags'],'form' => $this->_tpl_vars['form'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

<b>Add an Amenity:</b>
<form action="edittags.php" method="POST" id="tagform" onsubmit="return AjaxForm(this, $('tagList'));">
<input type="text" name="new_tag" id="new_tag" size="35" onkeypress="return commaSubmit(this, event);"/><input type="submit" value="Add">
<div id="suggestionBox"></div>
<input type="hidden" name="action" value="add">
<input type="hidden" name="on" value="<?php echo $this->_tpl_vars['form']['on']; ?>
">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['form']['id']; ?>
">
</form>
</td></tr></table>
<div style="text-align:center; margin-top: 5mm;"><a href="javascript: window.close();">Close</a></div>