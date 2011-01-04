<form action="editaccount.php" method="POST">

{if $user.type=='owner'}

	<table class=displayTable cellspacing=0>
	<thead><td colspan=2 style="text-align: center;">Edit Contact Information</td></thead>
	<tr>
		<td width="130px" style="  text-align: right;">First Name:</td>
		<td><input type="text" name='first_name' value="{$user.first_name}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Last Name:</td>
		<td><input type="text" name='last_name' value="{$user.last_name}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Email Address:</td>
		<td><input type="text" name='email' value="{$user.email}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Phone Number:</td>
		<td><input type="text" name='phone' value="{$user.phone}"></td>
	</tr>
	<tr>
		<td colspan='2'>
			<p style='color:#999;'>
			If you're a representative of a managment company, enter <br>
			the name of that company here (Otherwise leave blank):
			</p>
		</td>
	</tr>
	<tr>
		<td style="  text-align: right;">Company Name:</td><td><input type="text" name='company' value="{$user.company}" size='50'></td>
	</tr>

	<thead><td colspan=2 style="text-align: center;">Change Password</td></thead>
	<tr>
		<td style="  text-align: right;">Current Password:</td>
		<td><input type="password" name='cur_pass' size='15'></td>
	</tr>
	<tr>
		<td style="  text-align: right;">New Password:</td>
		<td><input type="password" name='new_pass' size='15'></td>
	</tr>
	<tr>
		<td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td>
		<td><input type="password" name='con_pass' size='15'></td>
	</tr>

	<tr><td>&nbsp;</td>
		<td><input type="submit" name='action' value="Save"></td>
	</tr>

	<thead>
		<td colspan=2>
			Account Type
		</td>
	</thead>
	
	<tr>
		<td style="vertical-align: text-top; padding-top: 4mm;">
			<input type="submit" name="action" value="Change to Student">
		</td>
		<td>
			<blockquote style="font-weight:bold; font-size: 110%;">You are a Property Owner</blockquote>
			<p>
				Change to a student account if you want to star property you're interested 
				in renting so it's easy to find in your profile. You can change back at any time.
		</td>
	</tr>
	</table>

{elseif $user.type=='student'}

	<table class=displayTable cellspacing=0>
	<thead><td colspan=2 style="text-align: center;">Edit Contact Information</td></thead>
	<tr>
		<td width="130px" style="  text-align: right;">First Name:</td>
		<td><input type="text" name='first_name' value="{$user.first_name}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Last Name:</td>
		<td><input type="text" name='last_name' value="{$user.last_name}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Email Address:</td>
		<td><input type="text" name='email' value="{$user.email}"></td>
	</tr>
	<tr>
		<td style="  text-align: right;">Phone Number:</td>
		<td><input type="text" name='phone' value="{$user.phone}"></td>
	</tr>

	<thead><td colspan=2 style="text-align: center;">Change Password</td></thead>
	<tr>
		<td style="  text-align: right;">Current Password:</td>
		<td><input type="password" name='cur_pass' size='15'></td>
	</tr>
	<tr>
		<td style="  text-align: right;">New Password:</td>
		<td><input type="password" name='new_pass' size='15'></td>
	</tr>
	<tr>
		<td style="font-size: 85%; color: #999; text-align: right; font-weight: bold;">x2</td>
		<td><input type="password" name='con_pass' size='15'></td>
	</tr>

	<tr><td>&nbsp;</td>
		<td><input type="submit" name='action' value="Save"></td>
	</tr> 	

	<thead>
		<td colspan=2>
			Account Type
		</td>
	</thead>
	
	<tr>
		<td style="vertical-align: text-top; padding-top: 4mm;">
			<input type="submit" name="action" value="Change to Property Owner">
		</td>
		<td>
			<blockquote style="font-weight:bold; font-size: 110%;">You are a Student</blockquote>
			<p>
				Change to a property owner's account if you want to post listings of property
				you own. You can change back at any time.
		</td>
	</tr>
	</table>

{/if}

</form>
