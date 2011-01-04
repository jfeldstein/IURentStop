<?php /* Smarty version 2.6.18, created on 2010-06-06 15:04:29
         compiled from help.tpl */ ?>
<form action="help.php" method=POST>

<input name="from_page" value="<?php echo $this->_tpl_vars['referrer']; ?>
" type="hidden">


	<table class=displayTable cellspacing=0>
	<thead>
		<td colspan=2>Send us an email so we can fix it</td>
	</thead>
	<tr>
		<td>Name:</td>
		<td>
			<?php if ($this->_tpl_vars['user']['full_name'] != ''): ?>
				<?php echo $this->_tpl_vars['user']['full_name']; ?>

				<input type="hidden" name='name' value='<?php echo $this->_tpl_vars['user']['full_name']; ?>
'>
			<?php else: ?>
				<input type=text name="name" value="<?php echo $this->_tpl_vars['form']['name']; ?>
">
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>Email Address:</td>
		<td>
			<?php if ($this->_tpl_vars['user']['email'] != ''): ?>
				<?php echo $this->_tpl_vars['user']['email']; ?>

				<input type="hidden" name='from' value='<?php echo $this->_tpl_vars['user']['email']; ?>
'>
			<?php else: ?>
				<input type=text name="from" value="<?php echo $this->_tpl_vars['form']['from']; ?>
">
			<?php endif; ?>
			</td>
	</tr>
	<tr>
		<td>Subject:</td>
		<td><input type=text name="subject" value="<?php echo $this->_tpl_vars['form']['subject']; ?>
"></td>
	</tr>
	<tr>
		<td>A friendly message:</td>
		<td><textarea name="body" cols=40 rows=4><?php echo $this->_tpl_vars['form']['body']; ?>
</textarea></td>
	</tr>
	<tr>
		<td colspan=2 align=center><input type="submit" name='action' value='Send It'></td>
	</tr>
	</table>
	
	<?php if (0): ?>
		<table class=displayTable cellspacing=0>
		<thead>
			<td>Frequently Asked Questions</td>
		</thead>
		<tr><td>
			<p>At the moment, we don't have a list of questions and answers, but as we get asked some we'll 
			add them here for convenience.</p>
		</td></tr></table>
	<?php endif; ?>
	
</form>