<?php /* Smarty version 2.6.18, created on 2010-06-06 14:03:19
         compiled from prompt_for_contact.tpl */ ?>
<form action="editaccount.php" method="POST">

<input type="hidden" name="forward" value="<?php echo $this->_tpl_vars['forward']; ?>
">

<table class=displayTable cellspacing=0>
<thead><td colspan=2 style="text-align: center;">How Should Students Contact You?</td></thead>
<tr>
	<td colspan=2>
		<blockquote>
		Before you can list properties, we need to make sure that students who're interested in 
		your properties can contact you. Please update your account to include your name and phone
		number.
		</blockquote>
	</td>
</tr>
<tr>
	<td width="130px">First Name:</td>
	<td><input type="text" name='first_name' value="<?php echo $this->_tpl_vars['user']['first_name']; ?>
"></td>
</tr>
<tr>
	<td>Last Name:</td>
	<td><input type="text" name='last_name' value="<?php echo $this->_tpl_vars['user']['last_name']; ?>
"></td>
</tr>
<tr>
	<td>Phone Number:</td>
	<td><input type="text" name='phone' value="<?php echo $this->_tpl_vars['user']['phone']; ?>
"></td>
</tr>
<tr>
	<td colspan='2'>
		<p>
		If you're a representative of a managment company, enter <br>
		the name of that company here (Otherwise leave blank):
		</p>
	</td>
</tr>
<tr>
	<td>Company Name:</td><td><input type="text" name='company' value="<?php echo $this->_tpl_vars['user']['company']; ?>
" size="50"></td>
</tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name='action' value="Update"></td>
</tr>
</table>

</form>