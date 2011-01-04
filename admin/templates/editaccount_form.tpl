<form action="editUser.php" method="POST">
<input type="hidden" name='id' value="{$user.id}">


<table cellspacing=0 class='closed displayTable'>
<thead onclick="this.parentNode.toggleClassName('closed');"><td colspan=2 style="text-align: center;">Edit {$user.full_name}'s Information</td></thead>
<tr>
	<td width="130px">First Name:</td>
	<td><input type="text" name='first_name' value="{$user.first_name}"></td>
</tr>
<tr>
	<td>Last Name:</td>
	<td><input type="text" name='last_name' value="{$user.last_name}"></td>
</tr>
<tr>
	<td>Email Address:</td>
	<td><input type="text" name='email' value="{$user.email}"></td>
</tr>
<tr>
	<td>Phone Number:</td>
	<td><input type="text" name='phone' value="{$user.phone}"></td>
</tr>
	<td>Company Name:</td><td><input type="text" name='company' value="{$user.company}"></td>
</tr>
<tr><td><input type="reset" value="Reset"></td>
	<td><input type="submit" name='action' value="Save"></td>
</tr>
</table>

</form>
