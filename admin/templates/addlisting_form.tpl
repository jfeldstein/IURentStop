<form action="addlisting.php" method="post">
<input type="hidden" name="location_type" value="{$location_type}">

<table class=displayTable >
<thead><td colspan=2>Add a new {$location_type}:</td></thead>

{if $location_type=='house'}
	<tr><td>Reference Name</td><td><input type="text" name="location_name" value="{$form.location_name}" ></td></tr>
	<tr><td>Street Address</td><td><input type="text" name="location_address" value="{$form.location_address}"></td></tr>
	<tr><td>Bedrooms</td><td><input type="text" name="space_bedrooms" value="{$form.space_bedrooms}" size="7" onkeypress="return numbersonly(this, event);"></td></tr>
	<tr><td>Bathrooms</td><td><input type="text" name="space_bathrooms" value="{$form.space_bathrooms}" size="7" onkeypress="return numbersonly(this, event, true);"></td></tr>
	<tr><td>Rent</td><td><input type="text" name="space_rent" value="{$form.space_rent}" class="money" size="6" onkeypress="return numbersonly(this, event);"></td></tr>
	<tr><td>Available for Rent?</td><td>{html_options options=$yesno name=space_available selected=$form.space_available}</td></tr>
	<tr>
		<td>
			<input type="hidden" name="space_num_present" value="1">
			<input type="hidden" name="space_available" value="1">
		</td>
		<td><input type="submit" name="save" value="Add It"></td>
	</tr>
{else}
	<tr><td>Reference Name</td><td><input type="text" name="location_name" value="{$form.location_name}" ></td></tr>
	<tr><td>Street Address</td><td><input type="text" name="location_address" value="{$form.location_address}" ></td></tr>
	</table>

	<table class=displayTable cellspacing=0>
	<thead><td colspan=2>One type of apartment available in this building has:</td></thead>
	<tr><td>Bedrooms</td><td><input type="text" name="space_bedrooms" value="{$form.space_bedrooms}" size="7" onkeypress="return numbersonly(this, event);"></td></tr>
	<tr><td>Bathrooms</td><td><input type="text" name="space_bathrooms" value="{$form.space_bathrooms}" size="7" onkeypress="return numbersonly(this, event, true);"></td></tr>
	<tr><td>Rent</td><td><input type="text" name="space_rent" value="{$form.space_rent}" class="money" size="6" onkeypress="return numbersonly(this, event, true);"></td></tr>
	<tr><td>Available for Rent?</td><td>{html_options options=$yesno name=space_available selected=$form.space_available}</td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" name="save" value="Add It"></td></tr>

{/if}

</table>

<div style="text-align:center; margin-top: 5mm;"><a href="welcome.php">Back</a></div>
</form>