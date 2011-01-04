<?php /* Smarty version 2.6.18, created on 2010-06-06 13:21:20
         compiled from password_retrieval.tpl */ ?>
<table class="displayTable" cellspacing=0 id='nogeocode'>
<thead><td>I Forgot My Password</td></thead>
<tr>
	<td>
		<?php if ($this->_tpl_vars['newpass'] != ''): ?>
			<p>
				Your password has been reset to 
				<blockquote><b><?php echo $this->_tpl_vars['newpass']; ?>
</b></blockquote>
				You're logged in already, and can
				change your password if you don't want to get stuck with
				that hard to remember one.
			</p>
			
			<form action="./editaccount.php" method="POST">
			<table border=0 style="margin: 3mm auto;">
				<tr>
					<td style="  text-align: right;">New Password:</td>
					<td><input type="password" name='new_pass' size='15'></td>
				</tr>
				<tr>
					<td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td>
					<td><input type="password" name='con_pass' size='15'></td>
				</tr>

				<tr><td>&nbsp;</td>
					<td>
						<input type="submit" name='action' value="Change Password">
						<input type="hidden" name="cur_pass" value="<?php echo $this->_tpl_vars['newpass']; ?>
">
					</td>
				</tr>
			</table>
			</form>
		<?php elseif ($this->_tpl_vars['email'] != ''): ?>
			<p>
				A link to reset your password has been sent to: '<b><?php echo $this->_tpl_vars['email']; ?>
</b>'.
			</p>
			<p>
				You should get it in a few minutes, but the link will only be good for a couple hours so check soon.
			</p>
		<?php else: ?>
			<p>
				Opps... It happens to the best of us. We can send an email to you that will let you reset
				your password. Just put it in the box below:
			</p>
			<br>
			<form action=forgotpass.php style="text-align: center;">
				<input type="text" name="email" title="Your email address">
				<input type="submit" value="Send Email">
			</form>
		<?php endif; ?>
	</td>
</tr></table>