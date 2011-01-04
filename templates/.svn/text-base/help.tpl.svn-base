<form action="help.php" method=POST>

<input name="from_page" value="{$referrer}">


	<table class=displayTable cellspacing=0>
	<thead>
		<td colspan=2>Send us an email so we can fix it</td>
	</thead>
	<tr>
		<td>Name:</td>
		<td>
			{if $user.full_name!=''}
				{$user.full_name}
				<input type="hidden" name='name' value='{$user.full_name}'>
			{else}
				<input type=text name="name" value="{$form.name}">
			{/if}
		</td>
	</tr>
	<tr>
		<td>Email Address:</td>
		<td>
			{if $user.email!=''}
				{$user.email}
				<input type="hidden" name='from' value='{$user.email}'>
			{else}
				<input type=text name="from" value="{$form.from}">
			{/if}
			</td>
	</tr>
	<tr>
		<td>Subject:</td>
		<td><input type=text name="subject" value="{$form.subject}"></td>
	</tr>
	<tr>
		<td>A friendly message:</td>
		<td><textarea name="body" cols=40 rows=4>{$form.body}</textarea></td>
	</tr>
	<tr>
		<td colspan=2 align=center><input type="submit" name='action' value='Send It'></td>
	</tr>
	</table>
	
	{if 0}
		<table class=displayTable cellspacing=0>
		<thead>
			<td>Frequently Asked Questions</td>
		</thead>
		<tr><td>
			<p>At the moment, we don't have a list of questions and answers, but as we get asked some we'll 
			add them here for convenience.</p>
		</td></tr></table>
	{/if}
	
</form>