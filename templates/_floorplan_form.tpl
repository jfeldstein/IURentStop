<div style="background-color:#DDD; border-bottom:1px solid #000; padding-left:3mm;margin-bottom:3mm;">
		<form action="floorplanmanager.php" method="post" enctype='multipart/form-data' onsubmit="return AIM.submit(this, {literal}{'onStart': getCaption, 'onComplete':completeCallback }{/literal});">
			<input type='submit' value='Add this floorplan:'> 
			<input type='file' id='item_data' name='item_data'>
			<input type='hidden' name='target_type' value='space'>
			<input type='hidden' name='target_id' value='{$target_id}'>
			<input type='hidden' name='action' value='addfloorplan'>
			<input type='hidden' name='caption' id='caption'>
		</form>
</div>
{foreach from=$obj.all_floorplans item=floorplan name=floorplan_loop}
	{if $smarty.foreach.floorplan_loop.first}
		<table class="displayTable" style='width: 90%; margin-left: 5mm;'>
		<thead>
			<td>
			{if $obj.type=='house'}
			{if $target_type=='location'}
				The House's Exterior
			{else}
				The House's Interior
			{/if}
		{else}
			{if $target_type=='location'}
				The Building's Exterior
			{else}
				The Interior of the {$obj.bedrooms}Br, {$obj.bathrooms}Bath, ${$obj.rent} Apartment
			{/if}
		{/if}
			</td>
		</thead>
		<tr><td>
			Floorplans of This Apartment: {$floorplans_total}<br>
			{$floorplans_visible_total} of them are shown to the public. <br>
	{/if}
	<table style='display: inline; width: 80px;'>
	<tr><td>
		<img id='floorplan_{$floorplan.id}' src='floorplans/small/{$floorplan.id}.gif' class='imageBtn {if $floorplan.visible}visible{/if}'>
	</td></tr>
	<tr><td style='font-size:10px;margin-top:-1mm; text-align: center; width: 80px; argin: auto;'>
			&quot;{$floorplan.caption}&quot;
			<br>
			<a href='#' onclick="delete_image('{$floorplan.id}')">Delete</a>
			-
			<a href='#' onclick="recaption_image('{$floorplan.id}')">Edit</a>
	</td></tr></table>
	{if $smarty.foreach.floorplan_loop.last}
		</td></tr></table>
	{/if}
{foreachelse}
	<div style="font-weight: bold; margin: -3mm 0 3mm 2.5cm;">
		Find a floorplan to upload
		<img src="images/arrow_curve_left_up.gif">
	</div>
	
{/foreach}

