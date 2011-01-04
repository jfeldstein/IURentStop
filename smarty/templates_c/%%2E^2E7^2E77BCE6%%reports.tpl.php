<?php /* Smarty version 2.6.18, created on 2009-03-12 00:29:54
         compiled from reports.tpl */ ?>
<div class="pageTitle">Reports</class>

<table class=displayTable cellspacing=0>
<thead}<td colspan=4>Houses</td></thead>
<thead>
	<td>Address</td>
	<td>Searches</td>
	<td>Views</td>
	<td>Contacts</td>
</thead>
<?php $_from = $this->_tpl_vars['houses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['location']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['location']['address']; ?>
</td>
	<td><?php echo $this->_tpl_vars['location']['searches']; ?>
 (<?php echo $this->_tpl_vars['location']['searches_percent']; ?>
%)</td>
	<td><?php echo $this->_tpl_vars['location']['views']; ?>
 (<?php echo $this->_tpl_vars['location']['views_percent']; ?>
%)</td>
	<td><?php echo $this->_tpl_vars['location']['contacts']; ?>
 (<?php echo $this->_tpl_vars['location']['contacts_percent']; ?>
%)</td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan=4 style="text-align:center; font-style:italic;">No houses listed</td></tr>
<?php endif; unset($_from); ?>
</table>

<table class=displayTable cellspacing=0>
<thead}<td colspan=4>Apartments</td></thead>
<thead>
	<td>Address</td>
	<td>Searches</td>
	<td>Views</td>
	<td>Contacts</td>
</thead>
<?php $_from = $this->_tpl_vars['apartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['location']):
?>
<tr>
	<td><?php echo $this->_tpl_vars['location']['address']; ?>
</td>
	<td><?php echo $this->_tpl_vars['location']['searches']; ?>
 (<?php echo $this->_tpl_vars['location']['searches_percent']; ?>
%)</td>
	<td><?php echo $this->_tpl_vars['location']['views']; ?>
 (<?php echo $this->_tpl_vars['location']['views_percent']; ?>
%)</td>
	<td><?php echo $this->_tpl_vars['location']['contacts']; ?>
 (<?php echo $this->_tpl_vars['location']['contacts_percent']; ?>
%)</td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan=4 style="text-align:center; font-style:italic;">No houses listed</td></tr>
<?php endif; unset($_from); ?>
</table>