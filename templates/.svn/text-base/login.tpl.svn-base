<div style="text-align: center;margin-top: 1cm;">
	<div class="pageTitle">Log Into Your Account</div>

	{if $wrong_creds}
	<div class="message">Your password was wrong or that email isn't registered</div>
	{/if}

	<form action="login.php" method="post">
	<table style='margin: auto;'>
	<tr><td>Email</td><td><input type="text" name='email' value="{$email}"></td></tr>
	<tr><td>Password</td><td><input type="password" name='pass'></td></tr>
	<tr><td>&nbsp;</td><td>
		<input type="submit" name="action" value="Login">
		{if $forward_to}<input type="hidden" name="forward_to" value="{$forward_to}">{/if}
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