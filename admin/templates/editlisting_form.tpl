<script language="javascript">
	{literal}
	Event.observe(window, 'load', function() {
		tagSuggestions = new Ajax.Autocompleter('new_tag', 'suggestionBox', 'tagSuggest.php', {});
	});
	{/literal}
</script>

<a href="savelocation.php?id={$location.id}&delete=1" onclick="return confirm('Are you sure you want to delete this location?');" style="float:right;"><img src="./images/delete.png" valign="middle">Delete</a>

<div class="pageTitle">
	{if $location.name!=''}{$location.name}<br>{/if}
	{$location.address}
</div>

<div><a href="welcome.php">Back</a></div>

<table class="displayTable">
<thead>
	<td>Building Details</td>
	<td>Building Amenities</td>
</thead>
<tr>
	<td valign="top">
		<form action="savelocation.php">
		<table>
		<tr><td>Name:</td><td><input type="text" name='location_name' value='{$location.name}'></td></tr>
		<tr><td>Address:</td><td><input type="text" name='location_address' value='{$location.address}'></td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" value="Save Address"></td></tr>
		</table>
		<input type="hidden" name="id" value="{$location.id}">
		</form>
		
		<br><br>
	</td>
	<td valign="top" align="center">
		{foreach from=$location.tags item=tag name=am_loop}
			{if $smarty.foreach.am_loop.first}
			<table>
			{/if}
			
			<tr>
			<td>
				<a href="delete_tag.php?on={$form.on}&id={$form.id}&tag_id={$tag.id}">
				<img src="images/delete.png">
				</a>
			</td><td>{$tag.text}</td></tr>
			
			{if $smarty.foreach.am_loop.last}
			</table>
			{/if}
		{foreachelse}
		<p>None, yet.</p>
		{/foreach}
		<br>
		<b>Add an Amenity:</b>
		<form action="edittags.php" method="POST">
		<input type="text" name="new_tag" id="new_tag" size="35"/><input type="submit" name="action" value="Add">
		<div id="suggestionBox"></div>
		<input type="hidden" name="on" value="location">
		<input type="hidden" name="id" value="{$location.id}">
		</form>
	</td>
</tr></table>

<table class="displayTable">
<tr>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editfloorplans.php?location_id={$location.id}')" value="Add Floorplans">
	</td>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editphotos.php?location_id={$location.id}')" value="Add Photos">
	</td>
</tr>
</table>

<form action="savespace.php">	

<table class="spaceTable">
<thead>
	<td colspan=5 style="text-align: center;">
		Living Space Details
	</td>
</thead>
<thead>
	<td>Bedrooms</td>
	<td>Bathrooms</td>
	<td>Rent</td>
	<td>Available</td>
	<td style="width:200px;">&nbsp;</td>
</thead>
{foreach from=$location.spaces item=space name=space_loop}
	{if $edit_space_id==$space.id}
		<tr>
			<td><input type="text" name="space_bedrooms" value="{$space.bedrooms}" size="7" onkeypress="return numbersonly(this, event);"></td>
			<td><input type="text" name="space_bathrooms" value="{$space.bathrooms}" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_rent" value="{$space.rent}" class="money" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td>{html_options options=$yesno name=space_available selected=$space.available}</td>
			<td>
				<input type="submit" name="action" value="Save">
				-
				<input type="button" value="Cancel" onclick="window.history.go(-1)">
				-
				<a href="savespace.php?id={$space.id}&action=delete"><img src="images/delete.png" alt="Delete"></a>
				<input type="hidden" name="id" value="{$space.id}">
			</td>
		</tr>
	{else}
		<tr onclick="document.location='editlisting.php?id={$location.id}&sid={$space.id}';">
			<td>{$space.bedrooms}</td>
			<td>{$space.bathrooms}</td>
			<td>${$space.rent}</td>
			<td>{if $space.available>0}Yes!{else}No{/if}</td>
			<td>
				<a href="editlisting.php?id={$location.id}&sid={$space.id}">Edit</a> 
				
				{if $location.type=='apartment'}
					- 
					<a href="edittags.php?on=space&id={$space.id}" target="amenities" onclick="return false" >Amenities</a>
				{/if}
			</td>
		</tr>
	{/if}
{/foreach}
{if $location.type=='apartment' || $smarty.foreach.space_loop.total==0}
	{if $edit_space_id=='new'}
			<tr>
				<td><input type="text" name="space_bedrooms" value="{$form.space_bedrooms}" size="7" onkeypress="return numbersonly(this, event, false);"></td>
				<td><input type="text" name="space_bathrooms" value="{$form.space_bathrooms}" size="7" onkeypress="return numbersonly(this, event, true);"></td>
				<td><input type="text" name="space_rent" value="{$form.space_rent}" class="money" size="7" onkeypress="return numbersonly(this, event, true);"></td>
				<td>{html_options options=$yesno name=space_available selected=$form.space_available}</td>
				<td>
					<input type="submit" name="action" value="Save">
				-
				<input type="button" value="Cancel" onclick="window.history.go(-1)">
					<input type="hidden" name="id" value="new">
					<input type="hidden" name="location_id" value="{$location.id}">
				</td>
			</tr>
	{else}
		<tr onclick="document.location='editlisting.php?id={$location.id}&sid=new';" id="newSpaceRow"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><a href="editlisting.php?id={$location.id}&sid=new">New</a></td></tr>
	{/if}
{/if}
</table>

</form>