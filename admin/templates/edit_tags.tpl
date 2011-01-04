<script language="javascript">
	{literal}
	Event.observe(window, 'load', function() {
		tagSuggestions = new Ajax.Autocompleter('new_tag', 'suggestionBox', 'tagSuggest.php', {});
	});
	{/literal}
</script>

<div class="pageTitle">
	{if $location.name!=''}{$location.name}<br>{/if}
	{$location.address}
</div>

<table width="100%"><tr><td valign="top">
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
</td><td valign="top" align="center">

<b>Current Amenities:</b><br>
{foreach from=$current_amenities item=tag name=am_loop}
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
<input type="hidden" name="on" value="{$form.on}">
<input type="hidden" name="id" value="{$form.id}">
</form>
</td></tr></table>
<div style="text-align:center; margin-top: 5mm;"><a href="javascript: window.close();">Close</a></div>