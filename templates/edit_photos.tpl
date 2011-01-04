<script language="javascript">
managerType = 'photo';
</script>

<div id='links' style='text-align:center;margin-bottom:0;'>
	{literal}
	<select onchange="update_manager(this);" id="targeter">
	{/literal}
		<option value='#'>Add photos of...</option>
		
		{if $location.type=='house'}
			<option value="{json target_type='location' target_id=$location.id}">The House's Exterior</option>
			<option value="{json target_type='space' target_id=$location.spaces[0].id}">The House's Interior</option>
		{else}
			<option value="{json target_type='location' target_id=$location.id}">The Building's Exterior</option>
			{foreach from=$location.spaces item=space}
				<option value="{json target_type='space' target_id=$space.id}">Apartment: {$space.bedrooms}Br {$space.bathrooms}Bath ${$space.rent}</option>
			{/foreach}
		{/if}
	</select>
</div>

<div id="theDiv">
	{include file='_photos_default.tpl'}
</div>
