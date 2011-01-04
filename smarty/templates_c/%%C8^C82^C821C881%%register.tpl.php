<?php /* Smarty version 2.6.18, created on 2010-06-06 13:34:48
         compiled from register.tpl */ ?>
<?php if ($this->_tpl_vars['type'] == 'owner'): ?>

	<form action="register.php" method="post" id="ownerForm">
	
		<input type="hidden" name="forward" value="<?php echo $this->_tpl_vars['form']['forward']; ?>
">
		<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
">
		
		<table class=displayTable cellspacing=0>
		<thead><td colspan=2>Create your IURentStop.com account:</td></thead>
		<tr><td style="text-align: right;">Email Address</td><td><input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"></td></tr>
		<tr><td style="text-align: right;">Password</td><td><input type="password" name="pass" value=""></td></tr>
		<tr><td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td><td><input type="password" name="confirm_pass" value=""></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td colspan=2><b>If you want to list properties, we also need to know:</b></td></tr>
		<tr><td width="250" style="text-align: right;">First Name</td><td><input type="text" name="first_name" value="<?php echo $this->_tpl_vars['first_name']; ?>
"></td></tr>
		<tr><td style="text-align: right;">Last Name</td><td><input type="text" name="last_name" value="<?php echo $this->_tpl_vars['last_name']; ?>
"></td></tr>
		<tr><td style="text-align: right;">Phone</td><td><input type="text" name="phone" value="<?php echo $this->_tpl_vars['phone']; ?>
"></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td colspan=2><b>Do you work for a property managment company?</b></td></tr>
		<tr>
			<td>If you do, tell us the name here:</td>
			<td>
				<input type="text" name="company" value="<?php echo $this->_tpl_vars['company']; ?>
" size="50">
			</td>
		</tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="action" value="Register"></td></tr>
		</table>
	</form>
<?php elseif ($this->_tpl_vars['type'] == 'student'): ?>
	<form action="register.php" method="post" id="studentForm">
	
		<input type="hidden" name="forward" value="<?php echo $this->_tpl_vars['form']['forward']; ?>
">
		<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
">
		
		<table class=displayTable cellspacing=0>
		<thead><td colspan=2>Create your IURentStop.com account:</td></thead>
		<tr><td style="text-align: right;">Email Address</td><td><input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"></td></tr>
		<tr><td style="text-align: right;">Password</td><td><input type="password" name="pass" value=""></td></tr>
		<tr><td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td><td><input type="password" name="confirm_pass" value=""></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="action" value="Register"></td></tr>
		</table>
	</form>
<?php endif; ?>