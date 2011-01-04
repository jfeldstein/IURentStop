{if $object_photos_total<2}
	<div style="background-color:#DDD; border-bottom:1px solid #000; padding-left:3mm;margin-bottom:3mm;">
			<form action="photomanager.php" method="post" enctype='multipart/form-data' onsubmit="return AIM.submit(this, {literal}{'onStart': getCaption, 'onComplete':completeCallback }{/literal});">
				<input type='submit' value='Add this photo:'> 
				<input type='file' id='item_data' name='item_data'>
				<input type='hidden' name='target_type' value='{$target_type}'>
				<input type='hidden' name='target_id' value='{$target_id}'>
				<input type='hidden' name='action' value='addphoto'>
				<input type='hidden' name='caption' id='caption'>
			</form>
	</div>
{/if}
{foreach from=$obj.all_photos item=photo name=photo_loop}
	{if $smarty.foreach.photo_loop.first}
		<table class="displayTable" style='width: 90%; margin-left: 5mm;'>
		<thead>
			<td>
		{if $location.type=='house'}
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
			{if 0}
			Total Photos: {$photos_total} ({$photos_visible_total} shown, using {$credits_used} of {$credits} extra photos allowed)<br>
			Photos Shown Here: {$object_photos_total} ({$object_photos_visible} are shown on this listing)<br>
			{/if}
	{/if}
	<table style='display: inline; width: 80px;'>
	<tr><td>
		<img id='photo_{$photo.id}' src='photos/small/{$photo.id}.jpg' class='imageBtn {if $photo.visible}visible{elseif $photo.active}withheld{else}off{/if}'>
	</td></tr>
	<tr><td style='font-size:10px;margin-top:-1mm; text-align: center; width: 80px; argin: auto;'>
			&quot; {$photo.caption} &quot;
			<br>
			<a href='#' onclick="delete_image('{$photo.id}')">Delete</a>
			-
			<a href='#' onclick="recaption_image('{$photo.id}')">Edit</a>
	</td></tr></table>
	
	{if $smarty.foreach.photo_loop.last}
		</td></tr></table>
	{/if}
{foreachelse}
	<div style="font-weight: bold; margin: -3mm 0 3mm 2.5cm;">
		Find a photo to upload
		<img src="images/arrow_curve_left_up.gif">
	</div>
	
{/foreach}

