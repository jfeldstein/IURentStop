<script language="javascript">
	{literal}
	Event.observe(window, 'load', function() {
		tagSuggestions = new Ajax.Autocompleter('new_tag', 'suggestionBox', 'tagSuggest.php', {'frequency':.3});
		$('new_tag').focus();
	});
	{/literal}
</script>

<table class="displayTable">
<tr>
	<td width="60%">
		<div class="pageTitle" style="padding-bottom: 0; margin-bottom:0;">
			{if $location.name!=''}{$location.name}<br>{/if}
			{$location.address} <br>
		</div>
	</td>
	<td>
		<a href="welcome.php">Back</a>
	</td>
	<td>
		<a href="savelocation.php?id={$location.id}&delete=1"  onclick="return confirm('Are you sure you want to delete this entire listing?\n\n\t\tThere is no undo.');" style="float:right;"><img src="./images/delete.png" style="vertical-align: text-bottom; " valign="middle">Delete Listing</a>
	</td>
		
	{if $location.premium}
		<tr>
			<td colspan=3>
			<div class="pseudoHR">&nbsp;</div>
			<div style="font-size: 80%; text-align: center;"><b>Featured Listing</b> - Show first in search results, and highlighed to stand out from the rest</div>
			</td>
		</tr>
	{/if}
</tr>
</table>

<table class="displayTable">
<thead>
	<td>Building Details</td>
	<td>Building Amenities</td>
</thead>
<tr>
	<td valign="top">
		<form action="savelocation.php">
		<table>
		<tr><td>Name:</td>
			<td>
				<input type="text" name='location_name' value='{$location.name}'>
				<img src="images/help.png" onmouseover="tooltip.show('Does this property have a nickname that students are more likely to recognize than its address?', 200);" onmouseout="tooltip.hide();">
			</td></tr>
		<tr><td>Address:</td><td><input type="text" name='location_address' value='{$location.address}'></td></tr>
		<tr><td>Building:</td><td>
			<select name="location_type">
				{html_options options=$house_or_apartment selected=$location.type}
			</select>
		</td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" value="Save Address"></td></tr>
		</table>
		<input type="hidden" name="id" value="{$location.id}">
		</form>
		
		<br><br>
	</td>
	<td valign="top" align="center">
		
		<div id="tagList">
			{include file="_taglist.tpl" tags=$location.tags form=$form}
		</div>
		
		<b>Add an Amenity:</b>
		<form action="edittags.php" method="POST" id="tagform" onsubmit="return AjaxForm(this, $('tagList'));">
		<input type="text" name="new_tag" id="new_tag" size="35" onkeypress="return commaSubmit(this, event);"/><input type="submit" value="Add">
		<div style="font-size: 80%; font-style: italic;">Type a word to see suggestions</div>
		<div id="suggestionBox"></div>
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="on" value="location">
		<input type="hidden" name="id" value="{$location.id}">
		</form>
	</td>
</tr></table>
<form action="savespace.php">	

<table class="displayTable">
<thead>
	<td colspan=6 style="text-align: center;">
		Units at this address
	</td>
</thead>
<thead>
	<td style="width:80px;">Bedrooms</td>
	<td style="width:80px;">Baths</td>
	<td style="width:80px;">Rent</td>
	<td style="width: 140px;">Size</td>
	<td style="width:100px;">Available</td>
	<td style="width:200px;">&nbsp;</td>
</thead>
{foreach from=$location.spaces item=space name=space_loop}
	{if $edit_space_id==$space.id}
		<tr>
			<td><input type="text" name="space_bedrooms" value="{$space.bedrooms}" size="2" onkeypress="return numbersonly(this, event);"></td>
			<td><input type="text" name="space_bathrooms" value="{$space.bathrooms}" size="3" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_rent" value="{$space.rent}" class="money" size="6" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_sqfootage" value="{$space.sqfootage}" size="7" onkeypress="return numbersonly(this, event);"><span style="font-size: 80%;">sq feet</style></td>
			<td>{html_options options=$yesno name=space_available selected=$space.available}</td>
			<td>
				<input type="submit" name="action" value="Save">
				-
				<input type="button" value="Cancel" onclick="window.history.go(-1)">
				-
				<a href="savespace.php?id={$space.id}&action=delete" onclick="return confirm('Are you sure you want to delete this entire listing?\n\n\t\tThere is no undo.');"><img src="images/delete.png" style="vertical-align: middle;" alt="Delete"></a>
				<input type="hidden" name="id" value="{$space.id}">
			</td>
		</tr>
	{else}
		<tr>
			<td>{$space.bedrooms}</td>
			<td>{$space.bathrooms}</td>
			<td>${$space.rent}</td>
			<td>{if $space.sqfootage > 0}{$space.sqfootage} <span style="font-size: 80%;">sq feet</style>{/if}</td>
			<td>{if $space.available>0}Yes!{else}No{/if}</td>
			<td>
				<a href="editlisting.php?id={$location.id}&sid={$space.id}">Edit</a> 
					
				{if 0}
					-
					<a href="reports.php?id={$space.id}">Reports</a>
				{/if}
				
				{if $location.type=='apartment' || $smarty.foreach.space_loop.total > 1}
					- 
					<a href="#" onclick="return pop_tags('edittags.php?on=space&id={$space.id}');" >Amenities</a>
				{/if}
			</td>
		</tr>
	{/if}
{/foreach}
{if $edit_space_id=='new'}
		<tr>
			<td><input type="text" name="space_bedrooms" value="{$form.space_bedrooms}" size="7" onkeypress="return numbersonly(this, event, false);"></td>
			<td><input type="text" name="space_bathrooms" value="{$form.space_bathrooms}" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_rent" value="{$form.space_rent}" class="money" size="7" onkeypress="return numbersonly(this, event, true);"></td>
			<td><input type="text" name="space_sq_footage" value="{$space.sq_footage}" size="4" onkeypress="return numbersonly(this, event);">sq feet</td>
			<td>{html_options style="width: 50px;" options=$yesno name=space_available selected=$form.space_available}</td>
			<td>
				<input type="submit" name="action" value="Save">
			-
			<input type="button" value="Cancel" onclick="window.history.go(-1)">
				<input type="hidden" name="id" value="new">
				<input type="hidden" name="location_id" value="{$location.id}">
			</td>
		</tr>
{else}
	<tr id="newSpaceRow"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><a href="editlisting.php?id={$location.id}&sid=new">New</a></td></tr>
{/if}
</table>

</form>



<table class="displayTable">
<thead>
	<td colspan=2 style="text-align: center;">
		Add to Listings
	</td>
</thead>
<tr>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editfloorplans.php?location_id={$location.id}')" value="Add Floorplans">
	</td>
	<td style="text-align: center;">
		<input type='button' onclick="return pop_tags('editphotos.php?location_id={$location.id}')" value="Add Photos">
	</td>
</tr>
</table>
