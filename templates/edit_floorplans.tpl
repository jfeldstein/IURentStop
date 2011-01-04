<script language="javascript">
managerType = 'floorplan';
</script>

<div id='links' style='text-align:center;margin-bottom:0;'>
	{literal}
	<select onchange="update_manager();" id="targeter">
	{/literal}
		<option value='#'>Add floorplans for...</option>
		
		{if $location.type=='house'}
			<option value="{json target_type='space' target_id=$location.spaces[0].id}">The House's Interior</option>
		{else}
			{foreach from=$location.spaces item=space}
				<option value="{json target_type='space' target_id=$space.id}">Apartment: {$space.bedrooms}Br {$space.bathrooms}Bath ${$space.rent}</option>
			{/foreach}
		{/if}
	</select>
</div>

<div id="theDiv">
	{include file='_floorplan_default.tpl'}
</div>
