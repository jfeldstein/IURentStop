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
		<p style='margin-top: 3mm;'>Create a <a href="register.php">new account</a></p>		
	</td></tr>
	</table>
	</form>

	<br><br>
	
	<blockquote style="margin: auto; width: 13cm;">
		<b>We're very new, so accounts are only for landlords at the moment.</b>
		There's a lot more to come at IURentStop.com that we'll have ready at the 
		start of the 2008 Fall semester.
	</blockquote>
</div>