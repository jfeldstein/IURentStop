<?php /* Smarty version 2.6.18, created on 2009-03-12 00:05:11
         compiled from _taglist.tpl */ ?>

			<?php $_from = $this->_tpl_vars['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['am_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['am_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tag']):
        $this->_foreach['am_loop']['iteration']++;
?>
				<?php if (($this->_foreach['am_loop']['iteration'] <= 1)): ?>
				<table width=100%>
				<?php endif; ?>
				
				<tr>
				<td width="6">
					<form action="delete_tag.php?on=<?php echo $this->_tpl_vars['form']['on']; ?>
&id=<?php echo $this->_tpl_vars['form']['id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag']['id']; ?>
" onsubmit="return AjaxForm(this, $('tagList'))">
					<input type="image" src="images/delete.png">
					</form>
				</td><td><?php echo $this->_tpl_vars['tag']['text']; ?>
</td></tr>
				
				<?php if (($this->_foreach['am_loop']['iteration'] == $this->_foreach['am_loop']['total'])): ?>
				</table>
				<?php endif; ?>
			<?php endforeach; else: ?>
			<p>None, yet.</p>
			<?php endif; unset($_from); ?>