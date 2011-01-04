<?php /* Smarty version 2.6.18, created on 2009-03-12 00:05:04
         compiled from login.tpl */ ?>
<div style="text-align: center;margin-top: 1cm;">
	<div class="pageTitle">Log Into Your Account</div>

	<?php if ($this->_tpl_vars['wrong_creds']): ?>
	<div class="message">Your password was wrong or that email isn't registered</div>
	<?php endif; ?>

	<form action="login.php" method="post">
	<table style='margin: auto;'>
	<tr><td>Email</td><td><input type="text" name='email' value="<?php echo $this->_tpl_vars['email']; ?>
"></td></tr>
	<tr><td>Password</td><td><input type="password" name='pass'></td></tr>
	<tr><td>&nbsp;</td><td>
		<input type="submit" name="action" value="Login">
		<?php if ($this->_tpl_vars['forward_to']): ?><input type="hidden" name="forward_to" value="<?php echo $this->_tpl_vars['forward_to']; ?>
"><?php endif; ?>
	</td></tr>
	<tr>
		<td></td> 	
		<td style="padding-top: 5mm;text-align:left;">
		<a href="forgotpass.php">Forgot password</a>
		</td>
	</tr>
		
	</table>
	</form>	
</div>