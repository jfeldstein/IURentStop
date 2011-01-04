<script language="javascript">
	{literal}
	Event.observe(window, 'load', function() {
		tagSuggestions = new Ajax.Autocompleter('new_tag', 'suggestionBox', 'tagSuggest.php', {});
		$('new_tag').focus();
	});
	{/literal}
</script>

<div class="pageTitle">
	{if $location.name!=''}{$location.name}<br>{/if}
	{$location.address}
</div>

<table width="100%"><tr><td valign="top">
	<div style="margin: 1mm; border: 1px solid black; background-color: #FFF; padding: 1mm;">
		{if $form.on=='space'}
		<b>Amenities for:</b>
			<table>
			<tr><td width="110px">Bedrooms</td><td>{$space.bathrooms}</td></tr>
			<tr><td>Bathrooms</td><td>{$space.bathrooms}</td></tr>
			<tr><td>Rent</td><td>${$space.rent}</td></tr>
			<tr><td>Available?</td><td>{if $space.available}Yes{else}No{/if}</td></tr>
			</table>
		{else}
		{if $location.type=='apartment'}<p>These amenities are for this address as well as all apartments that are part of it</p>{/if}
		{/if}
	</div>
</td><td valign="top" align="center">

<b>Current Amenities:</b><br>


		<div id="tagList">
			{include file="_taglist.tpl" tags=$tags form=$form}
		</div>

<b>Add an Amenity:</b>
<form action="edittags.php" method="POST" id="tagform" onsubmit="return AjaxForm(this, $('tagList'));">
<input type="text" name="new_tag" id="new_tag" size="35" onkeypress="return commaSubmit(this, event);"/><input type="submit" value="Add">
<div id="suggestionBox"></div>
<input type="hidden" name="action" value="add">
<input type="hidden" name="on" value="{$form.on}">
<input type="hidden" name="id" value="{$form.id}">
</form>
</td></tr></table>
<div style="text-align:center; margin-top: 5mm;"><a href="javascript: window.close();">Close</a></div>