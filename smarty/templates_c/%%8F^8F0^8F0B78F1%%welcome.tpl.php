<?php /* Smarty version 2.6.18, created on 2009-03-12 00:05:05
         compiled from welcome.tpl */ ?>

<?php if ($this->_tpl_vars['user']['type'] == 'owner'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'myproperties.tpl', 'smarty_include_vars' => array('forward' => 'welcome.php')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['user']['type'] == 'student'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'saved_spaces.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>