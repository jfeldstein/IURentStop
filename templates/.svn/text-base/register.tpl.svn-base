{if $type=='owner'}

	<form action="register.php" method="post" id="ownerForm">
	
		<input type="hidden" name="forward" value="{$form.forward}">
		
		<table class=displayTable cellspacing=0>
		<thead><td colspan=2>Create your IURentStop.com account:</td></thead>
		<tr><td style="text-align: right;">Email Address</td><td><input type="text" name="email" value="{$email}"></td></tr>
		<tr><td style="text-align: right;">Password</td><td><input type="password" name="pass" value=""></td></tr>
		<tr><td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td><td><input type="password" name="confirm_pass" value=""></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td colspan=2><b>If you want to list properties, we also need to know:</b></td></tr>
		<tr><td width="250" style="text-align: right;">First Name</td><td><input type="text" name="first_name" value="{$first_name}"></td></tr>
		<tr><td style="text-align: right;">Last Name</td><td><input type="text" name="last_name" value="{$last_name}"></td></tr>
		<tr><td style="text-align: right;">Phone</td><td><input type="text" name="phone" value="{$phone}"></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td colspan=2><b>Do you work for a property managment company?</b></td></tr>
		<tr>
			<td>If you do, tell us the name here:</td>
			<td>
				<input type="text" name="company" value="{$company}" size="50">
			</td>
		</tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="action" value="Register"></td></tr>
		</table>
	</form>
{elseif $type=='student'}
	<form action="register.php" method="post" id="studentForm">
	
		<input type="hidden" name="forward" value="{$form.forward}">
		
		<table class=displayTable cellspacing=0>
		<thead><td colspan=2>Create your IURentStop.com account:</td></thead>
		<tr><td style="text-align: right;">Email Address</td><td><input type="text" name="email" value="{$email}"></td></tr>
		<tr><td style="text-align: right;">Password</td><td><input type="password" name="pass" value=""></td></tr>
		<tr><td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td><td><input type="password" name="confirm_pass" value=""></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="action" value="Register"></td></tr>
		</table>
	</form>
{/if}